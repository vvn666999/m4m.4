document.addEventListener('DOMContentLoaded', function() {
  function ajaxNavigate(url) {
    fetch(url)
      .then(function(response) { return response.text(); })
      .then(function(html) {
        var parser = new DOMParser();
        var doc = parser.parseFromString(html, 'text/html');
        var content = doc.querySelector('body');
        if(content) {
          document.body.innerHTML = content.innerHTML;
        }
        history.pushState(null, '', url);
      });
  }

  document.body.addEventListener('click', function(e) {
    var link = e.target.closest('a[data-link]');
    if(link) {
      e.preventDefault();
      ajaxNavigate(link.getAttribute('href'));
    }
  });

  window.addEventListener('popstate', function() {
    ajaxNavigate(location.href);
  });
});
