<div id = "feed" class="space-y-6">
  <?php foreach ($posts as $post): ?>
    <div class="bg-white rounded-lg shadow p-4">

      <?php if (($post->image_url)!=""): ?>
        <img
          src="<?= htmlspecialchars('uploads/' . basename($post->image_url)) ?>"
          alt="Post image"
          class="w-full h-64 object-cover rounded mb-4"
        >
              <h2 class="font-semibold text-lg mb-2">
        <?=htmlspecialchars($post->title ?? 'Post title') ?>
      </h2>

      <?php else: ?>

              <h2 class="font-semibold text-lg mb-2">
        <?=htmlspecialchars($post->title ?? 'Post title') ?>
      </h2>


      <?php endif; ?>

      <p class="text-gray-700">
        <?= htmlspecialchars($post->description ?? 'Post content') ?>
      </p>

      <div class="mt-4 flex gap-4 text-sm">

        <form method="POST" action="/post/like">
          <input type="hidden" name="post_id" value="<?= (int)$post->id ?>">
          <button type="submit" class="flex items-center gap-1 text-blue-600">
             <i class="fa fa-thumbs-up"></i> <?= (int)($post->likes ?? 0) ?>
          </button>
        </form>
        
        <a
          href="/post/comments/<?= (int)$post->id ?>"
          class="flex items-center gap-1 text-gray-600"
        >
         <i class="fa fa-comment"></i><?= (int)($post->comments) ?>
        </a>
      </div>

    </div>
  <?php endforeach; ?>
</div>
