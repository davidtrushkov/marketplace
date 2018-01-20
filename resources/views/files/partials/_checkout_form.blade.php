<form action="{{ route('checkout.payment', $file) }}" method="POST">
    {{ csrf_field() }}
    <h3>${{ $file->price }}</h3>
    <script
            src="https://checkout.stripe.com/checkout.js"
            class="stripe-button"
            data-key="{{ $file->user->stripe_key }}"
            data-amount="{{ $file->price * 100 }}"
            data-name="{{ $file->title }}"
            data-description="{{ $file->overview_short }}"
            data-image="/images/icons/marketplace-logo.png"
            data-locale="auto"
            data-currency="usd"
            data-label="Buy Now"
    >
    </script>
    @if(auth()->user() && $currentUserOwnsThisFile > 0)
        <br />
        <p class="text-danger"><i>You already own this file</i></p>
    @endif
</form>