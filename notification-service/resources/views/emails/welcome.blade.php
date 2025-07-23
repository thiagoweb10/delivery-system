<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <title>Redefinição de Senha</title>
  </head>
  <body style="margin: 0; padding: 0; background-color: #e5e7eb; font-family: Arial, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #e5e7eb; padding: 40px 0;">
      <tr>
        <td align="center">
          <!-- Container principal -->
          <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0px 4px 14px rgba(0,0,0,0.1);">
            
            <!-- Cabeçalho com logo -->
            <tr>
              <td align="center" style="padding: 30px 0; background-color: #f0f0f0;">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="display: block;" />
              </td>
            </tr>
            
            <!-- Conteúdo principal -->
            <tr>
              <td style="padding: 40px 30px 20px 30px; text-align: center;">

                <p>Olá {{ $role }} <strong>{{ $name ?? 'Amigo' }}</strong>,</p>


                <p>Estamos muito felizes que você se juntou a nós! Agora você tem acesso a conteúdos exclusivos, novidades e ofertas especiais.</p>
                <p>Para começar, que tal visitar nosso site e conhecer tudo o que preparamos para você?</p>
                <a href="https://seusite.com" target="_blank" class="button">Conhecer o site</a>
                <p class="footer">Se você não solicitou este email, por favor ignore esta mensagem.</p>
              </td>
            </tr>

            <!-- Divisor -->
            <tr>
              <td style="padding: 0 30px;">
                <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 30px 0;" />
              </td>
            </tr>
            <!-- Rodapé -->
            <tr>
              <td style="background-color: #f3f4f6; text-align: center; padding: 20px; font-size: 12px; color: #9ca3af;">
                © 2025 SeuSistema. Todos os direitos reservados.<br/>
                suporte@seusistema.com.br
              </td>
            </tr>

          </table>
        </td>
      </tr>
    </table>
  </body>
</html>