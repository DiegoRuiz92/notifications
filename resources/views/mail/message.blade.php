@component('mail::message')
# Hola!
Haz click en el botón para abrir el mensaje en otra ventana

@component('mail::button', ['url' => route('messages.show', $message)])
Ver mensaje
@endcomponent

@component('mail::panel')
    {{$message->body}}
@endcomponent


Hasta Luego!

Cordial saludo,

C&A Temporales

@component('mail::subcopy')

If you're having trouble clicking the "Ver Mensaje" button, copy and paste the URL below into your web browser: <a href="{{route('messages.show', $message)}}"></a>

@endcomponent

@endcomponent
