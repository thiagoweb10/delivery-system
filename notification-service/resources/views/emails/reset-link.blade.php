<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Redefinição de Senha</title>
  <style>
    body {
      background-color: #f2f4f8;
      font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
      margin: 0;
      padding: 0;
      color: #2c3e50;
    }

    .email-wrapper {
      width: 100%;
      padding: 50px 0;
    }

    .email-content {
      max-width: 600px;
      margin: 0 auto;
      background-color: #ffffff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .email-header {
      padding: 15px;
      text-align: center;
      border-bottom: 1px solid #eaeaea;
      background-color: #ffffff;
    }

    .email-header img {
      max-height: 300px;
    }

    .email-body {
      padding: 40px 30px;
    }

    .email-body h1 {
      font-size: 22px;
      margin-bottom: 20px;
      color: #0077ff;
    }

    .email-body p {
      font-size: 16px;
      line-height: 1.6;
      color: #4d4d4d;
      margin-bottom: 30px;
    }

    .btn {
      display: inline-block;
      background-color: #0077ff;
      color: #ffffff !important;
      text-decoration: none;
      padding: 14px 28px;
      border-radius: 6px;
      font-weight: bold;
      box-shadow: 0 4px 10px rgba(0, 119, 255, 0.3);
    }

    .email-footer {
      padding: 30px;
      font-size: 13px;
      text-align: center;
      color: #999999;
      background-color: #fafafa;
      border-top: 1px solid #eaeaea;
    }

    @media (max-width: 600px) {
      .email-body {
        padding: 30px 20px;
      }

      .btn {
        padding: 12px 20px;
        font-size: 15px;
      }
    }
  </style>
</head>
<body>
  <div class="email-wrapper">
    <div class="email-content">

      <!-- Logo/Header -->
      <div class="email-header">
        <img src="{{ asset('images/logo.png') }}" alt="Delivery Service Logo">
      </div>

      <!-- Corpo do Email -->
      <div class="email-body">
        <h1>Redefinição de Senha</h1>
        <p>Olá,</p>
        <p>Recebemos uma solicitação para redefinir sua senha.</p>

        <h2><strong> {{ $token }}</strong></h2>
        
        <p>Se você não solicitou a redefinição, nenhuma ação é necessária.</p>
        <p>Atenciosamente,<br><strong>Equipe Delivery Service</strong></p>
      </div>

      <!-- Rodapé -->
      <div class="email-footer">
        © {{ date('Y') }} Delivery Service. Todos os direitos reservados.
      </div>

    </div>
  </div>
</body>
</html>