<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Sale;
use Stripe\Stripe;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;

class StripeWebhookController extends Controller
{

public function handleWebhook(Request $request)
{
    $payload = $request->getContent();
    $sigHeader = $request->header('Stripe-Signature');
    $endpointSecret = env('STRIPE_WEBHOOK_SECRET');

    // Log raw inputs for debugging
    Log::info('🧪 Stripe Webhook Received');
    Log::info('Signature Header: ' . $sigHeader);
    Log::info('Payload: ' . $payload);
    Log::info('Using Secret: ' . $endpointSecret);

    try {
        $event = Webhook::constructEvent($payload, $sigHeader, $endpointSecret);
    } catch (SignatureVerificationException $e) {
        Log::error('❌ Signature verification failed: ' . $e->getMessage());
        return response('Invalid signature', 400);
    } catch (\Exception $e) {
        Log::error('❌ Stripe Webhook Error: ' . $e->getMessage());
        return response('Webhook error', 400);
    }

    $object = $event->data->object;

    switch ($event->type) {
        case 'invoice.finalized':
        case 'invoice.paid':
        case 'invoice.voided':
        case 'invoice.marked_uncollectible':
            $invoiceId = $object->id;
            $status = $object->status;

            $sale = Sale::where('invoice_stripe_id', $invoiceId)->first();
            if ($sale) {
                $sale->status = $status;
                $sale->save();
                Log::info("✅ Sale status updated to {$status} for invoice {$invoiceId}");
            }
            break;

        case 'payment_intent.succeeded':
            if (!empty($object->invoice)) {
                $sale = Sale::where('invoice_stripe_id', $object->invoice)->first();
                if ($sale) {
                    $sale->status = 'paid';
                    $sale->save();
                    Log::info("✅ Sale marked as paid for invoice {$object->invoice}");
                }
            }
            break;

        default:
            Log::info("ℹ️ Received unhandled event type: {$event->type}");
            break;
    }

    return response('Webhook handled', 200);
}


}
