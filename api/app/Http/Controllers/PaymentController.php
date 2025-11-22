<?php
namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\Event;
use App\Models\Evenement;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;

class PaymentController extends Controller
{
    public function index (){
        return view('payment.index');
    }
    public function checkout(Event $event)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $event->title,
                    ],
                    'unit_amount' => $event->prix * 100, // en centimes
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success', $event),
            'cancel_url' => route('payment.cancel'),
        ]);

        return redirect($session->url);
    }

    public function success(Event $event)
    {
        // Ajouter l'inscription automatiquement
        auth()->user()->inscriptions()->create([
            'evenement_id' => $event->id,
        ]);

        return view('payments.success');
    }

    public function cancel()
    {
        return view('payments.cancel');
    }
}

