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
                <h1 style="font-size: 24px; margin: 0; color: #111827;">Esqueceu sua senha?</h1>
                <p style="font-size: 16px; color: #374151; margin: 20px 0;">
                  Não se preocupe, acontece! Basta clicar no botão abaixo para criar uma nova senha segura.
                </p>
                <a href="http://localhost:8081/reset-password?token={{ $token }}&email={{ urlencode($email) }}"
                   style="display: inline-block; padding: 14px 28px; background-color: #3b82f6; color: #ffffff; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 16px; margin-top: 20px;">
                  Redefinir minha senha
                </a>
                <p style="font-size: 14px; color: #6b7280; margin-top: 30px;">
                  Este link é válido por 60 minutos.
                </p>
              </td>
            </tr>

            <!-- Divisor -->
            <tr>
              <td style="padding: 0 30px;">
                <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 30px 0;" />
              </td>
            </tr>

            <!-- Mensagem de segurança -->
            <tr>
              <td style="padding: 0 30px 40px 30px; text-align: center;">
                <p style="font-size: 14px; color: #6b7280; margin: 0;">
                  Se você não solicitou a redefinição de senha, ignore este e-mail ou entre em contato com nosso suporte.
                </p>
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