<?php
require_once __DIR__ . '/db.php';

$success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $messageText = trim($_POST['message'] ?? '');

    if ($name !== '' && $email !== '' && $messageText !== '') {
        $insert = $db->prepare('INSERT INTO contactmessage (name, email, message, created_at) VALUES (:name, :email, :message, :created_at)');
        $insert->execute([
            ':name' => $name,
            ':email' => $email,
            ':message' => $messageText,
            ':created_at' => date('Y-m-d H:i:s'),
        ]);
        header('Location: contact.php?sent=1');
        exit;
    }
}

$contacts = $db->query('SELECT * FROM contact message ORDER BY id DESC')->fetchAll(PDO::FETCH_ASSOC);
$success = isset($_GET['sent']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact | Wiki Motors</title>
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

    .showcase {
      display: grid;
      grid-template-columns: 1.1fr 0.9fr;
      gap: 2rem;
      align-items: start;
      margin-top: 2rem;
    }

    .showcase-card,
    .contact-card {
      background: rgba(255, 255, 255, 0.06);
      border: 1px solid rgba(148, 163, 184, 0.15);
      border-radius: 28px;
      padding: 2rem;
      box-shadow: var(--shadow);
    }

    .showcase-card h3 {
      margin-bottom: 1rem;
    }

    .contact-card {
      display: grid;
      gap: 1rem;
    }

    .contact-card label {
      display: block;
      margin-bottom: 0.5rem;
      color: var(--muted);
      font-size: 0.95rem;
    }

    .contact-card input,
    .contact-card textarea {
      width: 100%;
      background: rgba(255, 255, 255, 0.08);
      border: 1px solid rgba(148, 163, 184, 0.2);
      border-radius: 16px;
      padding: 1rem 1.1rem;
      color: var(--text);
      font: inherit;
      resize: vertical;
    }

    .contact-card textarea {
      min-height: 180px;
    }

    .button {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 0.95rem 1.8rem;
      border-radius: 999px;
      font-weight: 600;
      transition: transform 0.2s ease, background 0.2s ease;
      background: linear-gradient(135deg, var(--accent), #f97316);
      color: #0f172a;
      border: none;
      cursor: pointer;
    }

    .button:hover {
      transform: translateY(-1px);
    }

    .data-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 2rem;
      background: rgba(255,255,255,0.05);
      border: 1px solid rgba(148,163,184,0.15);
      border-radius: 24px;
      overflow: hidden;
    }

    .data-table th,
    .data-table td {
      padding: 1rem 1.25rem;
      text-align: left;
      border-bottom: 1px solid rgba(148,163,184,0.12);
      color: var(--text);
    }

    .data-table th {
      background: rgba(255,255,255,0.08);
      color: var(--accent);
      font-weight: 600;
    }

    .success {
      display: inline-block;
      margin-top: 1rem;
      padding: 0.85rem 1.15rem;
      border-radius: 999px;
      background: rgba(34,197,94,0.15);
      color: #d9f99d;
    }

    footer {
      padding: 2rem 0 2.5rem;
      border-top: 1px solid rgba(148, 163, 184, 0.12);
      color: var(--muted);
      font-size: 0.95rem;
    }

    @media (max-width: 960px) {
      .showcase {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 680px) {
      .button {
        width: 100%;
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
          <a href="index.php">Home</a>
          <a href="contact.php">Contact</a>
        </div>
      </nav>
    </header>

    <main class="container">
      <section class="section">
        <div class="section-title">Get in touch</div>
        <h2>Contact our sales and support team</h2>
        <p>Need help finding the right car? Have questions about our collection or pricing? Send us a message and our team will get back to you shortly.</p>
        <?php if ($success): ?>
          <div class="success">Thank you! Your message has been saved.</div>
        <?php endif; ?>
      </section>

      <section class="showcase">
        <div class="showcase-card">
          <div class="section-title">Reach out</div>
          <h3>Quick support for every inquiry</h3>
          <p>Whether you want a personalized recommendation, financing help, or a test drive booking, our experts are ready to assist.</p>
          <ul>
            <li>Phone support: +1 (800) 555-0123</li>
            <li>Email: support@wikimotors.example</li>
            <li>Business hours: Mon - Fri, 9am - 6pm</li>
          </ul>
        </div>

        <div class="contact-card">
          <form action="contact.php" method="post">
            <label for="name">Name</label>
            <input id="name" name="name" type="text" placeholder="Your full name" required />

            <label for="email">Email</label>
            <input id="email" name="email" type="email" placeholder="you@example.com" required />

            <label for="message">Message</label>
            <textarea id="message" name="message" placeholder="Tell us what you need" required></textarea>

            <button type="submit" class="button">Send Message</button>
          </form>
        </div>
      </section>

      <section class="section">
        <div class="section-title">Saved contacts</div>
        <h2>Messages stored in the database</h2>
        <table class="data-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Message</th>
              <th>Submitted</th>
            </tr>
          </thead>
          <tbody>
            <?php if (count($contacts) === 0): ?>
              <tr>
                <td colspan="5">No contact messages have been submitted yet.</td>
              </tr>
            <?php else: ?>
              <?php foreach ($contacts as $contact): ?>
                <tr>
                  <td><?php echo htmlspecialchars($contact['id'], ENT_QUOTES, 'UTF-8'); ?></td>
                  <td><?php echo htmlspecialchars($contact['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                  <td><?php echo htmlspecialchars($contact['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                  <td><?php echo nl2br(htmlspecialchars($contact['message'], ENT_QUOTES, 'UTF-8')); ?></td>
                  <td><?php echo htmlspecialchars($contact['created_at'], ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </section>
    </main>

    <footer class="container">
      <p>Wiki Motors — Built for car lovers who demand style, selection, and performance.</p>
    </footer>
  </div>
</body>
</html>
