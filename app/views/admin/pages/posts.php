<div class="bg-white rounded shadow overflow-hidden">
  <table class="w-full text-sm">
    <thead class="bg-gray-100 text-left">
      <tr>
        <th class="p-3">Title</th>
        <th class="p-3">Created</th>
        <th class="p-3">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($posts as $post): ?>
        <tr class="border-t">
          <td class="p-3"><?= $post->title ?></td>
          <td class="p-3"><?= $post->created_at->format('Y-m-d H:i:s') ?></td>
          <td class="p-3 space-x-2">
              <form action="/admin/posts/edit/<?= (int)$post->id ?>" method="POST">
              <button class="text-blue-600">
                Edit
              </button>
              </form>
            <form action="/admin/posts/delete/<?= (int)$post->id ?>" method="POST">
              <button class="text-red-600">
                Delete
              </button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
