<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Bem-vindo</title>
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
      padding: 30px;
      text-align: center;
      background-color: #ffffff;
    }

    .email-header img {
      max-height: 300px;
    }

    .email-body {
      padding: 40px 30px;
    }

    .email-body h1 {
      font-size: 24px;
      color: #0077ff;
      margin-bottom: 20px;
    }

    .email-body p {
      font-size: 16px;
      line-height: 1.6;
      color: #4d4d4d;
      margin-bottom: 25px;
    }

    .email-footer {
      padding: 30px;
      font-size: 13px;
      text-align: center;
      color: #999999;
      background-color: #fafafa;
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
      margin-top: 20px;
    }

    @media (max-width: 600px) {
      .email-body {
        padding: 30px 20px;
      }
    }
  </style>
</head>
<body>
  <div class="email-wrapper">
    <div class="email-content">

      <!-- Cabeçalho -->
      <div class="email-header">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Delivery Service">
      </div>

      <!-- Corpo do Email -->
      <div class="email-body">
        <h1>Bem-vindo(a), {{ $data['name'] }}!</h1>

        @if ($data['role'] === 'customer')
          <p>É um prazer ter você conosco! A partir de agora, você pode solicitar entregas com agilidade, segurança e total praticidade.</p>
          <p>Nosso time está pronto para garantir que sua experiência seja excelente.</p>
          <p><strong>Faça seu primeiro pedido agora e veja como é fácil!</strong></p>
          <p style="text-align: center;">
            <a href="/cliente" class="btn">Acessar Plataforma</a>
          </p>
        @elseif ($data['role'] === 'courier')
          <p>Parabéns por fazer parte da nossa rede de entregadores!</p>
          <p>Com a Delivery Service, você tem liberdade para escolher seus horários e aumentar sua renda fazendo entregas na sua região.</p>
          <p><strong>Complete seu perfil e comece a receber pedidos!</strong></p>
          <p style="text-align: center;">
            <a href="/entregador" class="btn">Acessar Painel do Entregador</a>
          </p>
        @endif

        <p>Se precisar de ajuda, conte com nossa equipe de suporte.</p>
        <p>Abraços,<br><strong>Equipe Delivery Service</strong></p>
      </div>

      <!-- Rodapé -->
      <div class="email-footer">
        © {{ date('Y') }} Delivery Service. Todos os direitos reservados.
      </div>
    </div>
  </div>
</body>
</html>