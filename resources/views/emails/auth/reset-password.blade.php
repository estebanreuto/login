@component('mail::message')
# Recupera tu acceso 🔐

Hola, recibimos una solicitud para restablecer tu contraseña.  
Haz clic en el botón para continuar 👇

@component('mail::button', ['url' => $url])
Restablecer contraseña
@endcomponent

Si no solicitaste esto, ignora este mensaje.

Saludos,  
**Equipo VERTIX**
@endcomponent
