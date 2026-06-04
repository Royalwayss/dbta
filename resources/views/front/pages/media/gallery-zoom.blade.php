<style>
  #zoomModal {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 99999;
    background: rgba(0, 0, 0, 0.93);
    flex-direction: column;
  }

  .lb-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 20px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.12);
    flex-shrink: 0;
  }

  .lb-title {
    color: #fff;
    font-size: 1.2rem;
    font-weight: 600;
    letter-spacing: .03em;
  }

  .lb-counter {
    color: rgba(255, 255, 255, .45);
    font-size: .78rem;
    margin-top: 2px;
  }

  .lb-close-btn {
    background: none;
    border: 1px solid rgba(255, 255, 255, .3);
    color: #fff;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    font-size: 1.1rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  #lbViewer {
    flex: 1;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 0;
  }

  #lbImgWrap {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: grab;
    overflow: hidden;
  }

  #lbImg {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    user-select: none;
    pointer-events: none;
    transform-origin: center center;
    transition: transform .15s ease;
    display: block;
  }

  .lb-nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, .1);
    border: 1px solid rgba(255, 255, 255, .2);
    color: #fff;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    font-size: 1.2rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(6px);
    z-index: 2;
  }

  .lb-prev {
    left: 14px;
  }

  .lb-next {
    right: 14px;
  }

  .lb-zoom-controls {
    position: absolute;
    bottom: 14px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    align-items: center;
    gap: 6px;
    background: rgba(0, 0, 0, .65);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, .12);
    border-radius: 30px;
    padding: 5px 12px;
    z-index: 2;
  }

  .lb-divider {
    width: 1px;
    height: 16px;
    background: rgba(255, 255, 255, .15);
  }

  .lb-control-btn {
    background: none;
    border: none;
    color: rgba(255, 255, 255, .8);
    cursor: pointer;
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
  }

  .lb-control-btn.zoom {
    font-size: 1.2rem;
  }

  .lb-control-btn.reset {
    font-size: .85rem;
  }

  #lbZoomLabel {
    font-size: .72rem;
    color: rgba(255, 255, 255, .5);
    min-width: 38px;
    text-align: center;
  }

  .lb-thumbs-container {
    border-top: 1px solid rgba(255, 255, 255, .1);
    background: rgba(0, 0, 0, .5);
    padding: 10px 16px;
    overflow-x: auto;
    flex-shrink: 0;
    scrollbar-width: thin;
    scrollbar-color: rgba(255, 255, 255, .2) transparent;
  }

  #lbThumbs {
    display: flex;
    gap: 8px;
    min-width: max-content;
  }
</style>

<div id="zoomModal">

  <div class="lb-header">
    <div>
      <div id="lbTitle" class="lb-title"></div>
      <div id="lbCounter" class="lb-counter"></div>
    </div>

    <button class="lb-close-btn" onclick="closeLightbox()">✕</button>
  </div>

  <div id="lbViewer">

    <div id="lbImgWrap">
      <img id="lbImg" src="" alt="">
    </div>

    <button class="lb-nav-btn lb-prev" onclick="lbNavigate(-1)">
      &#8592;
    </button>

    <button class="lb-nav-btn lb-next" onclick="lbNavigate(1)">
      &#8594;
    </button>

    <div class="lb-zoom-controls">

      <button class="lb-control-btn zoom" onclick="lbZoom(-0.25)" title="Zoom out">
        −
      </button>

      <div class="lb-divider"></div>

      <span id="lbZoomLabel">100%</span>

      <div class="lb-divider"></div>

      <button class="lb-control-btn zoom" onclick="lbZoom(0.25)" title="Zoom in">
        +
      </button>

      <div class="lb-divider"></div>

      <button class="lb-control-btn reset" onclick="lbReset()" title="Reset zoom">
        ⟳
      </button>

    </div>

  </div>

  <div class="lb-thumbs-container">
    <div id="lbThumbs"></div>
  </div>

</div>

<!-- ═══════════════════════════════════════════
     LIGHTBOX SCRIPT
═══════════════════════════════════════════ -->
<script>
  
  (function() {
    /* ── state ── */
    var lb = {
      images: [], // array of src strings for current group
      index: 0,
      title: '',
      zoom: 1,
      px: 0,
      py: 0,
      base: '{{ url("/")}}/front/images/media/'
    };
    /* ── open ── */
    window.openLightbox = function(triggerImg) {
      var files = triggerImg.getAttribute('data-group-images').split('|');
      var curr = triggerImg.getAttribute('data-current');
      lb.title = triggerImg.getAttribute('data-title') || '';
      lb.images = files.map(function(f) {
        return lb.base + f;
      });
      lb.index = files.indexOf(curr);
      if (lb.index < 0) lb.index = 0;
      lb.zoom = 1;
      lb.px = 0;
      lb.py = 0;
      document.getElementById('zoomModal').style.display = 'flex';
      document.body.style.overflow = 'hidden';
      render();
    };
    /* ── close ── */
    window.closeLightbox = function() {
      document.getElementById('zoomModal').style.display = 'none';
      document.body.style.overflow = '';
    };
    /* ── navigate ── */
    window.lbNavigate = function(dir) {
      lb.index = (lb.index + dir + lb.images.length) % lb.images.length;
      lb.zoom = 1;
      lb.px = 0;
      lb.py = 0;
      render();
    };
    /* ── go to thumbnail ── */
    window.lbGoTo = function(idx) {
      lb.index = idx;
      lb.zoom = 1;
      lb.px = 0;
      lb.py = 0;
      render();
    };
    /* ── zoom ── */
    window.lbZoom = function(delta) {
      lb.zoom = Math.min(5, Math.max(0.5, lb.zoom + delta));
      if (lb.zoom <= 1) {
        lb.px = 0;
        lb.py = 0;
      }
      applyTransform();
    };
    window.lbReset = function() {
      lb.zoom = 1;
      lb.px = 0;
      lb.py = 0;
      applyTransform();
    };

    function applyTransform() {
      var img = document.getElementById('lbImg');
      img.style.transform = 'translate(' + lb.px + 'px,' + lb.py + 'px) scale(' + lb.zoom + ')';
      document.getElementById('lbZoomLabel').textContent = Math.round(lb.zoom * 100) + '%';
    }
    /* ── render ── */
    function render() {
      // main image
      document.getElementById('lbImg').src = lb.images[lb.index];
      document.getElementById('lbTitle').textContent = lb.title;
      document.getElementById('lbCounter').textContent = (lb.index + 1) + ' / ' + lb.images.length;
      applyTransform();
      // thumbnails
      var wrap = document.getElementById('lbThumbs');
      wrap.innerHTML = '';
      lb.images.forEach(function(src, i) {
        var img = document.createElement('img');
        img.src = src;
        img.alt = '';
        img.style.cssText = [
          'width:68px', 'height:50px', 'object-fit:cover',
          'border-radius:3px', 'cursor:pointer',
          'border:2px solid ' + (i === lb.index ? '#e74c3c' : 'transparent'),
          'opacity:' + (i === lb.index ? '1' : '0.45'),
          'transition:opacity .2s,border-color .2s,transform .2s',
          'flex-shrink:0'
        ].join(';');
        img.onmouseover = function() {
          if (i !== lb.index) this.style.opacity = '.75';
        };
        img.onmouseout = function() {
          if (i !== lb.index) this.style.opacity = '.45';
        };
        img.onclick = function() {
          lbGoTo(i);
        };
        wrap.appendChild(img);
      });
      // scroll active thumb into view
      var thumbs = wrap.querySelectorAll('img');
      if (thumbs[lb.index]) {
        thumbs[lb.index].scrollIntoView({
          inline: 'center',
          behavior: 'smooth'
        });
      }
    }
    /* ── mouse-wheel zoom ── */
    document.getElementById('lbViewer').addEventListener('wheel', function(e) {
      e.preventDefault();
      lbZoom(e.deltaY < 0 ? 0.15 : -0.15);
    }, {
      passive: false
    });
    /* ── drag to pan ── */
    var drag = null;
    var wrap = document.getElementById('lbImgWrap');
    wrap.addEventListener('mousedown', function(e) {
      if (lb.zoom <= 1) return;
      drag = {
        sx: e.clientX - lb.px,
        sy: e.clientY - lb.py
      };
      wrap.style.cursor = 'grabbing';
    });
    document.addEventListener('mousemove', function(e) {
      if (!drag) return;
      lb.px = e.clientX - drag.sx;
      lb.py = e.clientY - drag.sy;
      applyTransform();
    });
    document.addEventListener('mouseup', function() {
      drag = null;
      wrap.style.cursor = 'grab';
    });
    /* ── pinch zoom (touch) ── */
    var pinchDist = null;
    document.getElementById('lbViewer').addEventListener('touchstart', function(e) {
      if (e.touches.length === 2) {
        pinchDist = Math.hypot(
          e.touches[0].clientX - e.touches[1].clientX,
          e.touches[0].clientY - e.touches[1].clientY
        );
      }
    }, {
      passive: true
    });
    document.getElementById('lbViewer').addEventListener('touchmove', function(e) {
      if (e.touches.length === 2 && pinchDist !== null) {
        e.preventDefault();
        var d = Math.hypot(
          e.touches[0].clientX - e.touches[1].clientX,
          e.touches[0].clientY - e.touches[1].clientY
        );
        lbZoom((d - pinchDist) * 0.008);
        pinchDist = d;
      }
    }, {
      passive: false
    });
    document.getElementById('lbViewer').addEventListener('touchend', function() {
      pinchDist = null;
    });
    /* ── keyboard ── */
    document.addEventListener('keydown', function(e) {
      if (document.getElementById('zoomModal').style.display !== 'flex') return;
      if (e.key === 'Escape') closeLightbox();
      if (e.key === 'ArrowLeft') lbNavigate(-1);
      if (e.key === 'ArrowRight') lbNavigate(1);
      if (e.key === '+' || e.key === '=') lbZoom(0.25);
      if (e.key === '-') lbZoom(-0.25);
      if (e.key === '0') lbReset();
    });
    /* ── backdrop click to close ── */
    document.getElementById('zoomModal').addEventListener('click', function(e) {
      if (e.target === this) closeLightbox();
    });
    /* ── attach click handlers to all zoom-trigger images ── */
    /* runs after DOM + Owl Carousel have both settled         */
    function attachTriggers() {
      document.querySelectorAll('img.zoom-trigger').forEach(function(img) {
        img.addEventListener('click', function() {
          openLightbox(this);
        });
      });
    }
    // attach now (for already-rendered images)
    attachTriggers();
    // also attach after Owl Carousel finishes initialising
    if (window.jQuery) {
      jQuery(document).ready(function() {
        jQuery(document).on('initialized.owl.carousel', '.media-carousel', function() {
          attachTriggers();
        });
      });
    }
  })();
</script>