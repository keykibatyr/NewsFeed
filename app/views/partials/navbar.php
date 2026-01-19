<nav class="bg-white border-b">
  <div class="max-w-5xl mx-auto px-4 py-3 flex justify-between items-center">
    <a href="/" class="font-bold text-lg">NewsFeed</a>

    <ul class="flex items-center gap-4 text-sm">
      <li><a href="/" class="hover:underline">Feed</a></li>

      <?php if (!isset($_COOKIE['cookie_session'])): ?>
        <li><a href="/signin" id = signin class="hover:underline">Login</a></li>
        <li><a href="/signup" id = signup class="hover:underline">SignUp</a></li>
      <?php else: ?>
                <li><a href="/post" id = post calss="hover:underline">+ New Post</a></li>
        <li>
          <form action="/signout" id = 'signout' method="POST">
            <button type="submit" class="hover:underline">SignOut</button>
          </form>
        </li>
      <?php endif; ?>
    </ul>
  </div>
</nav>
