        <section id="galeria">
            <div class="gal_container">
                <h1>Galeria de fotos</h1>
                <div class="gal_container">
                    <div class="gal_gallery" id="gallery">
                       
                        <div class="gal_gallery-item">
                            <div class="gal_content"><img src="https://source.unsplash.com/random/?tech,studied" alt="">
                            </div>
                        </div>
                        <div class="gal_gallery-item">
                            <div class="gal_content"><img src="https://source.unsplash.com/random/?tech,substance" alt="">
                            </div>
                        </div>
                        <div class="gal_gallery-item">
                            <div class="gal_content"><img src="https://source.unsplash.com/random/?tech,choose" alt="">
                            </div>
                        </div>
                        <div class="gal_gallery-item">
                            <div class="gal_content"><img src="https://source.unsplash.com/random/?tech,past" alt="">
                            </div>
                        </div>
                        <div class="gal_gallery-item">
                            <div class="gal_content"><img src="https://source.unsplash.com/random/?tech,lamp" alt="">
                            </div>
                        </div>
                        <div class="gal_gallery-item">
                            <div class="gal_content"><img src="https://source.unsplash.com/random/?tech,yet" alt="">
                            </div>
                        </div>
                        <div class="gal_gallery-item">
                            <div class="gal_content"><img src="https://source.unsplash.com/random/?tech,eight" alt="">
                            </div>
                        </div>
                        <div class="gal_gallery-item">
                            <div class="gal_content"><img src="https://source.unsplash.com/random/?tech,crew" alt="">
                            </div>
                        </div>
                        <div class="gal_gallery-item">
                            <div class="gal_content"><img src="https://source.unsplash.com/random/?tech,event" alt="">
                            </div>
                        </div>
                        <div class="gal_gallery-item">
                            <div class="gal_content"><img src="https://source.unsplash.com/random/?tech,instrument" alt="">
                            </div>
                        </div>
                        <div class="gal_gallery-item">
                            <div class="gal_content"><img src="https://source.unsplash.com/random/?tech,practical" alt="">
                            </div>
                        </div>
                        <div class="gal_gallery-item">
                            <div class="gal_content"><img src="https://source.unsplash.com/random/?tech,pass" alt="">
                            </div>
                        </div>
                        <div class="gal_gallery-item">
                            <div class="gal_content"><img src="https://source.unsplash.com/random/?tech,bigger" alt="">
                            </div>
                        </div>
                        <div class="gal_gallery-item">
                            <div class="gal_content"><img src="https://source.unsplash.com/random/?tech,number" alt="">
                            </div>
                        </div>
                        <div class="gal_gallery-item">
                            <div class="gal_content"><img src="https://source.unsplash.com/random/?tech,feature" alt="">
                            </div>
                        </div>      
                        <div class="gal_gallery-item">
                            <div class="gal_content"><img src="https://source.unsplash.com/random/?tech,line" alt="">
                            </div>
                        </div>
                        <div class="gal_gallery-item">
                            <div class="gal_content"><img src="https://source.unsplash.com/random/?tech,railroad" alt="">
                            </div>
                        </div>
                        <div class="gal_gallery-item">
                            <div class="gal_content"><img src="https://source.unsplash.com/random/?tech,pride" alt="">
                            </div>
                        </div>
                        <div class="gal_gallery-item">
                            <div class="gal_content"><img src="https://source.unsplash.com/random/?tech,too" alt="">
                            </div>
                        </div>
                        <div class="gal_gallery-item">
                            <div class="gal_content"><img src="https://source.unsplash.com/random/?tech,bottle" alt="">
                            </div>
                        </div>
                        <div class="gal_gallery-item">
                            <div class="gal_content"><img src="https://source.unsplash.com/random/?tech,base" alt="">
                            </div>
                        </div>
                        <div class="gal_gallery-item">
                            <div class="gal_content"><img src="https://source.unsplash.com/random/?tech,beauty" alt="">
                            </div>
                        </div>
                        <div class="gal_gallery-item">
                            <div class="gal_content"><img src="https://source.unsplash.com/random/?tech,bag" alt="">
                            </div>
                        </div>
                        <div class="gal_gallery-item">
                            <div class="gal_content"><img src="https://source.unsplash.com/random/?tech,card" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script>
        var gallery = document.querySelector('#gallery');
        var getVal = function(elem, style) {
            return parseInt(window.getComputedStyle(elem).getPropertyValue(style));
        };
        var getHeight = function(item) {
            return item.querySelector('.gal_content').getBoundingClientRect().height;
        };
        var resizeAll = function() {
            var altura = getVal(gallery, 'gal_grid-auto-rows');
            var gap = getVal(gallery, 'grid-row-gap');
            gallery.querySelectorAll('.gal_gallery-item').forEach(function(item) {
                var el = item;
                el.style.gridRowEnd = "span " + Math.ceil((getHeight(item) + gap) / (altura + gap));
            });
        };
        gallery.querySelectorAll('img').forEach(function(item) {
            item.classList.add('byebye');
            if (item.complete) {
                console.log(item.src);
            } else {
                item.addEventListener('load', function() {
                    var altura = getVal(gallery, 'grid-auto-rows');
                    var gap = getVal(gallery, 'grid-row-gap');
                    var gitem = item.parentElement.parentElement;
                    gitem.style.gridRowEnd = "span " + Math.ceil((getHeight(gitem) + gap) / (altura + gap));
                    item.classList.remove('byebye');
                });
            }
        });
        window.addEventListener('gal_resize', resizeAll);
        gallery.querySelectorAll('.gal_gallery-item').forEach(function(item) {
            item.addEventListener('gal_click', function() {
                item.classList.toggle('gal_full');
            });
        });
    </script>