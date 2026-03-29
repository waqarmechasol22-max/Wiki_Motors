<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Wiki Motos | Find Your Dream Car</title>
  <style>
    :root {
      --bg: #0b1220;
      --bg-alt: #111827;
      --text: #f8fafc;
      --muted: #94a3b8;
      --accent: #f59e0b;
      --accent-dark: #b45309;
      --card: rgba(255, 255, 255, 0.08);
      --shadow: 0 24px 80px rgba(3, 12, 34, 0.35);
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: Inter, system-ui, sans-serif;
      background: linear-gradient(180deg, #09101c 0%, #121b2b 55%, #0d1320 100%);
      color: var(--text);
      line-height: 1.6;
    }

    img {
      display: block;
      max-width: 100%;
    }

    a {
      color: inherit;
      text-decoration: none;
    }

    .page {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .container {
      width: min(1200px, calc(100% - 2rem));
      margin: 0 auto;
    }

    header {
      padding: 1.25rem 0;
    }

    .nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 1rem;
    }

    .brand {
      font-size: 1.6rem;
      letter-spacing: 0.18em;
      font-weight: 700;
      text-transform: uppercase;
    }

    .nav-links {
      display: flex;
      gap: 1.1rem;
      flex-wrap: wrap;
      color: var(--muted);
      font-size: 0.95rem;
    }

    .nav-links a:hover {
      color: var(--accent);
    }

    .hero {
      display: grid;
      grid-template-columns: 1.1fr 0.9fr;
      align-items: center;
      gap: 2rem;
      padding: 4rem 0 5rem;
    }

    .hero-copy h1 {
      font-size: clamp(2.5rem, 4vw, 4.25rem);
      line-height: 1.02;
      letter-spacing: -0.04em;
      margin-bottom: 1rem;
    }

    .hero-copy p {
      max-width: 42rem;
      color: var(--muted);
      font-size: 1.05rem;
      margin-bottom: 2rem;
    }

    .hero-actions {
      display: flex;
      flex-wrap: wrap;
      gap: 1rem;
    }

    .button {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 0.95rem 1.8rem;
      border-radius: 999px;
      font-weight: 600;
      transition: transform 0.2s ease, background 0.2s ease;
    }

    .button-primary {
      background: linear-gradient(135deg, var(--accent), #f97316);
      color: #0f172a;
    }

    .button-secondary {
      border: 1px solid rgba(148, 163, 184, 0.35);
      color: var(--text);
      background: rgba(255, 255, 255, 0.05);
    }

    .button:hover {
      transform: translateY(-1px);
    }

    .hero-visual {
      position: relative;
      border-radius: 32px;
      overflow: hidden;
      background: radial-gradient(circle at top right, rgba(245, 158, 11, 0.18), transparent 45%),
        linear-gradient(180deg, rgba(255, 255, 255, 0.05), transparent);
      box-shadow: var(--shadow);
    }

    .hero-visual::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(180deg, rgba(14, 21, 42, 0.18), rgba(5, 10, 22, 0.92));
      pointer-events: none;
    }

    .hero-visual img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      aspect-ratio: 4 / 3;
    }

    .stat-grid {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 1rem;
      margin-top: 2rem;
    }

    .stat {
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(148, 163, 184, 0.18);
      padding: 1.25rem 1.5rem;
      border-radius: 24px;
      text-align: center;
    }

    .stat strong {
      display: block;
      font-size: 1.55rem;
      margin-bottom: 0.35rem;
      color: #fff;
    }

    .section {
      padding: 3rem 0;
    }

    .section-title {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      margin-bottom: 1rem;
      color: var(--accent);
      font-size: 0.95rem;
      text-transform: uppercase;
      letter-spacing: 0.18em;
    }

    .section h2 {
      font-size: clamp(2rem, 3vw, 3rem);
      margin-bottom: 0.75rem;
    }

    .section p {
      max-width: 54rem;
      color: var(--muted);
    }

    .cards {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 1.5rem;
      margin-top: 2rem;
    }

    .card {
      background: rgba(255, 255, 255, 0.06);
      border: 1px solid rgba(148, 163, 184, 0.15);
      border-radius: 28px;
      padding: 1.5rem;
      box-shadow: var(--shadow);
      transition: transform 0.25s ease, border-color 0.25s ease;
    }

    .card:hover {
      transform: translateY(-6px);
      border-color: rgba(245, 158, 11, 0.45);
    }

    .card h3 {
      margin-bottom: 0.95rem;
      font-size: 1.25rem;
    }

    .card p {
      color: var(--muted);
    }

    .showcase {
      display: grid;
      grid-template-columns: 1.1fr 0.9fr;
      gap: 2rem;
      align-items: center;
      margin-top: 2rem;
    }

    .showcase-card {
      background: linear-gradient(180deg, rgba(255,255,255,0.07), rgba(255,255,255,0.03));
      border: 1px solid rgba(148, 163, 184, 0.18);
      border-radius: 32px;
      padding: 2rem;
      position: relative;
      overflow: hidden;
    }

    .showcase-card::before {
      content: '';
      position: absolute;
      top: -20%;
      right: -20%;
      width: 220px;
      height: 220px;
      background: rgba(245, 158, 11, 0.12);
      border-radius: 50%;
      filter: blur(28px);
    }

    .showcase-card h3 {
      margin-bottom: 1rem;
    }

    .showcase-card ul {
      list-style: none;
      padding-left: 0;
      margin-top: 1.5rem;
      display: grid;
      gap: 1rem;
    }

    .showcase-card li {
      display: flex;
      align-items: center;
      gap: 0.85rem;
      color: var(--muted);
    }

    .showcase-card li::before {
      content: '✓';
      color: var(--accent);
      font-weight: 700;
    }

    footer {
      padding: 2rem 0 2.5rem;
      border-top: 1px solid rgba(148, 163, 184, 0.12);
      color: var(--muted);
      font-size: 0.95rem;
    }

    @media (max-width: 960px) {
      .hero, .showcase {
        grid-template-columns: 1fr;
      }
      .stat-grid, .cards {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 680px) {
      .hero {
        padding-top: 3rem;
      }
      .button {
        width: 100%;
      }
      .hero-actions {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>
  <div class="page">
    <header class="container">
      <nav class="nav">
        <div class="brand">Wiki Motors</div>
        <div class="nav-links">
          <a href="#discover">Discover</a>
          <a href="#features">Features</a>
          <a href="#collection">Collection</a>
          <a href="contact.php">Contact</a>
        </div>
      </nav>
    </header>

    <main class="container">
      <section class="hero">
        <div class="hero-copy">
          <p class="section-title">Luxury. Performance. Choice.</p>
          <h1>Find the perfect car for every road, every journey.</h1>
          <p>Wiki Motos helps you explore premium cars, compare top models, and choose the ride that fits your lifestyle. Browse curated collections from sports to luxury SUVs with confidence.</p>
          <div class="hero-actions">
            <a href="#collection" class="button button-primary">Browse the Collection</a>
            <a href="#features" class="button button-secondary">Why Choose Us</a>
          </div>
          <div class="stat-grid">
            <div class="stat">
              <strong>120+</strong>
              premium cars listed
            </div>
            <div class="stat">
              <strong>15k+</strong>
              happy drivers served
            </div>
            <div class="stat">
              <strong>4.9/5</strong>
              average review score
            </div>
          </div>
        </div>

        <div class="hero-visual">
          <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1200&q=80" alt="Luxury sports car" />
        </div>
      </section>

      <section id="features" class="section">
        <div>
          <div class="section-title">Our Service</div>
          <h2>Curated car discovery for every driver</h2>
          <p>From sporty coupes to luxurious family SUVs, Wiki Motos offers tailored recommendations, easy comparisons, and fast access to the best deals in the market.</p>
        </div>

        <div class="cards">
          <article class="card">
            <h3>Personalized selections</h3>
            <p>Discover cars matched to your budget, preferences, and driving style with expert guidance every step of the way.</p>
          </article>
          <article class="card">
            <h3>Trusted market insights</h3>
            <p>Detailed specifications, transparent pricing, and quick comparisons help you shop with clarity and confidence.</p>
          </article>
          <article class="card">
            <h3>Easy browsing</h3>
            <p>Clean layouts, intuitive filters, and modern search tools make it easy to find your dream ride fast.</p>
          </article>
        </div>
      </section>

      <section id="collection" class="section">
        <div class="showcase">
          <div class="showcase-card">
            <div class="section-title">Collections</div>
            <h2>Explore top models available now</h2>
            <p>Choose from a diverse selection of performance cars, elegant sedans, reliable SUVs, and electric vehicles designed for every need.</p>
            <ul>
              <li>Sport cars with razor-sharp handling</li>
              <li>Luxury sedans with premium comfort</li>
              <li>Family SUVs built for safety and space</li>
              <li>Electric models with intelligent efficiency</li>
            </ul>
          </div>
          <div>
            <img src="https://images.unsplash.com/photo-1511919884226-fd3cad34687c?auto=format&fit=crop&w=1200&q=80" alt="Car collection" />
          </div>
        </div>
      </section>
    </main>

    <footer class="container" id="contact">
      <p>Wiki Motos — Built for car lovers who demand style, selection, and performance. <a href="contact.php">Contact us anytime</a> for help matching the perfect car to your journey.</p>
    </footer>
  </div>
</body>
</html>
