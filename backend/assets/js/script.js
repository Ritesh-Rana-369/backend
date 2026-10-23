(function () {
  var root = document.documentElement;
  function applyTheme(t) {
    root.setAttribute('data-theme', t);
    var b = document.getElementById('themeToggle');
    if (b) b.textContent = t === 'dark' ? '☀ Light' : '🌙 Dark';
  }
  var saved = 'light';
  try { saved = localStorage.getItem('theme') || (matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'); } catch (e) {}
  applyTheme(saved);

  document.addEventListener('DOMContentLoaded', function () {
    applyTheme(root.getAttribute('data-theme'));
    document.getElementById('themeToggle').addEventListener('click', function () {
      var t = root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
      applyTheme(t);
      try { localStorage.setItem('theme', t); } catch (e) {}
    });
    document.getElementById('menuToggle').addEventListener('click', function () {
      document.getElementById('mainNav').classList.toggle('open');
    });
    document.querySelectorAll('.topic-toggle').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var card = btn.parentElement, open = card.classList.toggle('open');
        btn.setAttribute('aria-expanded', open);
      });
    });
    document.querySelectorAll('form[data-confirm]').forEach(function (f) {
      f.addEventListener('submit', function (ev) {
        if (!confirm(f.getAttribute('data-confirm'))) ev.preventDefault();
      });
    });
    document.querySelectorAll('form.validate, form.search-form').forEach(function (f) {
      f.addEventListener('submit', function (ev) {
        var bad = false;
        f.querySelectorAll('[required]').forEach(function (i) {
          var empty = !i.value.trim();
          i.classList.toggle('invalid', empty);
          if (empty) bad = true;
        });
        if (bad) { ev.preventDefault(); alert('Please fill in all required fields.'); }
      });
    });
    var items = document.querySelectorAll('.fade-in');
    if ('IntersectionObserver' in window) {
      var io = new IntersectionObserver(function (es) {
        es.forEach(function (en) { if (en.isIntersecting) { en.target.classList.add('show'); io.unobserve(en.target); } });
      }, { threshold: 0.1 });
      items.forEach(function (el, i) { el.style.transitionDelay = (i * 80) + 'ms'; io.observe(el); });
    } else items.forEach(function (el) { el.classList.add('show'); });
  });
})();
