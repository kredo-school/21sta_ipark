@extends('layouts.app')

@section('title', 'FAQ')

@section('content')

 <div class="container">
    <div class="col-md-8 my-4">
        <div class="h1 text-start"><span class="underline">&nbsp;FAQ</span></div>
    </div>

    <div class="faq-section">
        <div class="faq-category">
            <h3>Reservation</h3>
            <div class="faq-item">
                <p class="question"><span class="faq-q">Q:</span> Do I have to register to reserve parking slots?</p>
                <p class="answer"><span class="faq-a">A:</span> Yes, you can search parking places without registration however you need to register to reserve the parking slot.</p>
            </div>
            <div class="faq-item">
                <p class="question"><span class="faq-q">Q:</span> Is it possible to make a reservation by phone?</p>
                <p class="answer"><span class="faq-a">A:</span> No, telephone reservations are not accepted. Please make a reservation from the website.</p>
            </div>
            <div class="faq-item">
                <p class="question"><span class="faq-q">Q:</span> How far in advance can I make a reservation?</p>
                <p class="answer"><span class="faq-a">A:</span> Reservations can be made up to a months in advance of the date.</p>
            </div>
            <div class="faq-item">
                <p class="question"><span class="faq-q">Q:</span> Can I make a reservation that starts on the same day?</p>
                <p class="answer"><span class="faq-a">A:</span> Yes, if there is space at the parking place.</p>
            </div>
            <div class="faq-item">
                <p class="question"><span class="faq-q">Q:</span> Can I make a reservation for two vehicles?</p>
                <p class="answer"><span class="faq-a">A:</span> No, reservations are each for a single vehicle. For multiple vehicles, it is necessary to make multiple reservations.</p>
            </div>
            <div class="faq-item">
                <p class="question"><span class="faq-q">Q:</span> Can I still make a reservation if I don't know the dates or times yet?</p>
                <p class="answer"><span class="faq-a">A:</span> Reservations require the times and dates when your vehicle will enter and leave the parking area. Once you know these, you can make a reservation.</p>
            </div>
        </div>

        <div class="faq-category">
            <h3>Cancellation</h3>
            <div class="faq-item">
                <p class="question"><span class="faq-q">Q:</span> Can I change the date or extend the time after making a reservation?</p>
                <p class="answer"><span class="faq-a">A:</span> It is not possible to change the date or extend the time. Please cancel your reservation and try again.</p>
            </div>
            <div class="faq-item">
                <p class="question"><span class="faq-q">Q:</span> What should I do if I want to cancel a reservation?</p>
                <p class="answer"><span class="faq-a">A:</span> You can cancel a reservation from <span class="fw-semibold">Reservation</span> > click<span class="fw-semibold"> “Cancel Reservation”</span> button. Additionally, cancellations are possible up to the day before the reservation date. please make sure that cancellation on the day will not be refunded.</p>
            </div>
        </div>

        <div class="faq-category">
            <h3>Payment</h3>
            <div class="faq-item">
                <p class="question"><span class="faq-q">Q:</span> Can I make a reservation without a credit card?</p>
                <p class="answer"><span class="faq-a">A:</span> Unfortunately, a credit card is necessary to pay the reservation service. We do not accept other payment methods.</p>
            </div>
        </div>

    </div>
 </div>
    
@endsection