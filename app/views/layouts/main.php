<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $title ?? 'NewsFeed' ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">

  <?php include __DIR__ . '/../partials/navbar.php'; ?>

  <main class="max-w-3xl mx-auto py-8 px-4">
    <?= $content ?>
  </main>

</body>
</html>
