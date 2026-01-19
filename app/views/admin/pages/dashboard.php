<div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
  <div class="bg-white p-4 rounded shadow">
    <p class="text-sm text-gray-500">Total Posts</p>
    <p class="text-2xl font-bold"><?= $stats['posts'] ?? 0 ?></p>
  </div>

  <div class="bg-white p-4 rounded shadow">
    <p class="text-sm text-gray-500">Users</p>
    <p class="text-2xl font-bold"><?= $stats['users'] ?? 0 ?></p>
  </div>

  <div class="bg-white p-4 rounded shadow">
    <p class="text-sm text-gray-500">Comments</p>
    <p class="text-2xl font-bold"><?= $stats['comments'] ?? 0 ?></p>
  </div>
</div>
