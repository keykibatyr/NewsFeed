<div class="space-y-6">

  <!-- Comments list -->
  <?php foreach ($comments as $comment): ?>
    <div class="bg-white rounded-lg shadow p-4">
      <div class="text-sm text-gray-500 mb-1">
        <?= htmlspecialchars($comment->nickname ?? 'Anonymous') ?>
      </div>

      <p class="text-gray-800">
        <?= htmlspecialchars($comment->description) ?>
      </p>

      <div class="text-xs text-gray-400 mt-2">
        <?= htmlspecialchars($comment->created_at->format('Y-m-d H:i:s')) ?>
      </div>
    </div>
  <?php endforeach; ?>

  <!-- Add comment form -->
  <div class="bg-white rounded-lg shadow p-4">
    <form method="POST" action="/post/comments/{id}">
      <input type="hidden" name="post_id" value="<?= (int)$post_id ?>">

      <textarea
        name="content"
        required
        class="w-full border rounded p-2 mb-3"
        placeholder="Write a comment..."
      ></textarea>

      <button
        type="submit"
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
      >
        Comment
      </button>
    </form>
  </div>

</div>
