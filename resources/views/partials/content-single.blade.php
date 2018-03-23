<article @php(post_class())>
  <header>
    <h2 class="entry-title">{{ get_the_title() }}</h2>
    @include('partials/entry-meta')
  </header>
  <div class="entry-content h4">
    @php(the_content())
  </div>
  @php(comments_template('/partials/comments.blade.php'))
</article>
