<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        color: rgb(72, 100, 125);
        font-size: 1rem;
        padding: 1rem;
    }
    a {
        color: white;
        text-decoration: none;
    }
    #verify-button {
        background: rgb(159, 18, 57);
        padding: .8rem 0rem;
        margin: 2rem auto;
        width: 200px;
        border-radius: 6px;
        text-align: center;
    }
    #verify-button:hover {
        background: rgb(136, 19, 55);
    }
</style>

<p>Hi {{ $user->name }}!</p>

<p>To complete your registration with Truth Transparent, please verify your email address by clicking the button below.</p>

<div id="verify-button">
    <a href="{{ $url }}" as="button">Verify your email</a>
</div>

<p>Thank you for your interest.</p>

<p>Yours,</p>

<img style="height: 3.5rem" src="{{ $message->embed(base_path('public/storage/images/truthtransparentSolo.svg')) }}" alt="logo">