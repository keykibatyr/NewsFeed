<div class="bg-white rounded-lg shadow p-6 max-w-xl mx-auto">
  <h1 class="text-xl font-semibold mb-4">Create Post</h1>

  <form action="/post/create" method="POST" enctype="multipart/form-data" class="space-y-4">
    <div>
      <label class="block text-sm font-medium mb-1">Title</label>
      <input
        type="text"
        name="title"
        required
        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring"
      />
    </div>

    <div>
      <label class="block text-sm font-medium mb-1">Description</label>
      <textarea
        name="description"
        rows="4"
        required
        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring"
      ></textarea>
    </div>

    <div>
      <label class="block text-sm font-medium mb-1">Image</label>
      <input
        type="file"
        name="image"
        class="block w-full text-sm"
      />
    </div>

    <button
      type="submit"
      name ="submit"
      class="bg-black text-white px-4 py-2 rounded hover:opacity-90"
    >
      Publish
    </button>
  </form>
</div>
