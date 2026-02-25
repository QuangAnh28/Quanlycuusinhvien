<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>@yield('title', 'Đăng nhập | Phenikaa Alumni')</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <style>
    :root{
      --navy:#2F447A;
      --navy2:#233769;
      --navy3:#182a52;
      --orange:#F37021;
      --orange2:#FF8A3D;
      --text:#ECF2FF;
      --muted:#B9C7F2;
      --stroke: rgba(255,255,255,.14);
      --glass: rgba(25, 40, 86, .55);
      --shadow: 0 22px 60px rgba(0,0,0,.35);
      --radius: 22px;
    }

    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0;
      font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
      color: var(--text);
      background:
        radial-gradient(900px 600px at 18% 40%, rgba(243,112,33,.18), transparent 60%),
        radial-gradient(900px 650px at 85% 30%, rgba(120,160,255,.25), transparent 62%),
        radial-gradient(1000px 700px at 60% 85%, rgba(255,255,255,.08), transparent 60%),
        linear-gradient(135deg, var(--navy3), var(--navy));
      overflow-x:hidden;
    }

    .wrap{
      min-height:100%;
      display:grid;
      grid-template-columns: 1.15fr .85fr;
      gap: 40px;
      align-items:center;
      padding: 42px 56px;
    }

    @media (max-width: 980px){
      .wrap{grid-template-columns: 1fr; padding: 28px 18px;}
      .brand{order:2}
      .panel{order:1}
    }

    /* left branding */
    .brand{
      position:relative;
      padding: 10px 10px 10px 0;
    }
    .brand .bigmark{
      width:min(520px, 100%);
      opacity:.35;
      filter: drop-shadow(0 18px 50px rgba(0,0,0,.25));
      transform: translateY(6px);
    }
    .brand h1{
      margin: 22px 0 10px;
      font-size: clamp(28px, 3.2vw, 44px);
      letter-spacing: -.8px;
      line-height:1.08;
    }
    .brand p{
      margin:0;
      color: var(--muted);
      line-height:1.65;
      max-width: 58ch;
      font-size: 14.5px;
    }

    /* dotted pattern */
    .dots{
      position:absolute;
      inset:-120px -120px -120px -120px;
      background:
        radial-gradient(circle at 2px 2px, rgba(255,255,255,.12) 1.2px, transparent 1.3px);
      background-size: 18px 18px;
      opacity:.18;
      pointer-events:none;
      mask-image: radial-gradient(closest-side, rgba(0,0,0,.85), transparent 72%);
    }

    /* right login panel */
    .panel{
      display:flex;
      justify-content:center;
    }
    .card{
      width: min(460px, 100%);
      background: linear-gradient(180deg, rgba(255,255,255,.08), rgba(255,255,255,.02));
      border: 1px solid var(--stroke);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      padding: 28px;
      backdrop-filter: blur(12px);
      position:relative;
      overflow:hidden;
    }
    .card::before{
      content:"";
      position:absolute;
      inset: -2px -2px auto -2px;
      height: 140px;
      background: radial-gradient(420px 120px at 85% 10%, rgba(243,112,33,.35), transparent 60%);
      pointer-events:none;
    }

    .logo{
      display:flex;
      align-items:center;
      flex-direction:column;
      gap: 10px;
      text-align:center;
      margin-bottom: 16px;
    }
    .logo img{
      width: 74px;
      height: 74px;
      object-fit:contain;
      filter: drop-shadow(0 12px 28px rgba(0,0,0,.25));
    }
    .logo .uni{
      font-weight: 800;
      letter-spacing: 1px;
      font-size: 22px;
    }
    .logo .sys{
      margin-top:-4px;
      color: var(--muted);
      font-size: 13px;
      letter-spacing:.3px;
      font-weight: 600;
    }

    .title{
      margin: 12px 0 14px;
      font-size: 14px;
      color: rgba(236,242,255,.92);
      letter-spacing: .3px;
      font-weight: 700;
      text-align:center;
      text-transform: uppercase;
    }

    form{display:flex; flex-direction:column; gap: 12px; margin-top: 10px;}

    .field{
      display:flex;
      align-items:center;
      gap: 10px;
      padding: 12px 12px;
      border-radius: 14px;
      border: 1px solid rgba(255,255,255,.14);
      background: rgba(10, 18, 45, .28);
      transition: box-shadow .18s ease, border-color .18s ease;
    }
    .field:focus-within{
      border-color: rgba(243,112,33,.55);
      box-shadow: 0 0 0 4px rgba(243,112,33,.14);
    }
    .icon{width:18px;height:18px;opacity:.9;flex:0 0 auto}
    input{
      width:100%;
      background:transparent;
      border:none;
      outline:none;
      color: var(--text);
      font-size: 14px;
      padding: 2px 0;
    }
    input::placeholder{color: rgba(185,199,242,.75)}
    .toggle{
      border:none;
      background: rgba(255,255,255,.06);
      color: var(--muted);
      padding: 8px 10px;
      border-radius: 12px;
      cursor:pointer;
      font-weight: 800;
      font-size: 12px;
    }
    .toggle:hover{color:var(--text); background: rgba(255,255,255,.09);}

    .row{
      display:flex;
      justify-content:space-between;
      align-items:center;
      gap: 12px;
      margin-top: 2px;
      color: var(--muted);
      font-size: 12.5px;
    }
    .check{display:flex; align-items:center; gap: 10px; user-select:none}
    .check input{width:16px;height:16px; accent-color: var(--orange);}
    a{color: rgba(236,242,255,.92); text-decoration:none; font-weight:700}
    a:hover{text-decoration:underline}

    .btn{
      margin-top: 6px;
      border:none;
      border-radius: 14px;
      padding: 13px 14px;
      cursor:pointer;
      font-weight: 900;
      letter-spacing: .6px;
      color: white;
      background: linear-gradient(135deg, var(--orange), var(--orange2));
      box-shadow: 0 16px 34px rgba(243,112,33,.28);
      transition: transform .08s ease, filter .18s ease;
    }
    .btn:hover{filter: brightness(1.04);}
    .btn:active{transform: translateY(1px) scale(.99);}

    .alert{
      border-radius: 14px;
      padding: 10px 12px;
      font-size: 13px;
      line-height:1.4;
      border: 1px solid rgba(255,91,122,.35);
      background: rgba(255,91,122,.12);
      color: #ffd1da;
    }

    .footer{
      margin-top: 16px;
      color: rgba(185,199,242,.72);
      font-size: 12px;
      text-align:center;
    }
  </style>

  @stack('head')
</head>
<body>
  <div class="wrap">
    <section class="brand">
      <div class="dots" aria-hidden="true"></div>
      <img class="bigmark" src="{{ asset('images/Logo-DH-Phenikaa-V-Bl.webp') }}" alt="Phenikaa mark">
    </section>

    <section class="panel">
      @yield('content')
    </section>
  </div>

  @stack('scripts')
</body>
</html>