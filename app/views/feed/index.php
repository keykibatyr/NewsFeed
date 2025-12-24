
<div class="space-y-6">
  <?php foreach ($posts as $post): ?>
    <div class="bg-white rounded-lg shadow p-4">
      <h2 class="font-semibold text-lg mb-2">
        <?= htmlspecialchars($post['title'] ?? 'Post title') ?>
      </h2>

      <p class="text-gray-700">
        <?= htmlspecialchars($post['body'] ?? 'Post content') ?>
      </p>

      <div class="mt-4 text-sm text-gray-500 flex gap-4">
        <span>👍 0</span>
        <span>💬 0</span>
      </div>
    </div>
  <?php endforeach; ?>
</div>
