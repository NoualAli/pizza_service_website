<div class="scroll_top">
    <i class="bi bi-hand-index-thumb"></i>
</div>
@once
    @push('scripts')
        <script type="text/javascript">
            const scrollTop = document.querySelector('.scroll_top');
            if (scrollTop) {
                const togglescrollTop = function() {
                    window.scrollY > 100 ? scrollTop.classList.add('active') : scrollTop.classList.remove('active');
                }
                window.addEventListener('load', togglescrollTop);
                document.addEventListener('scroll', togglescrollTop);
                scrollTop.addEventListener('click', () => {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    })
                });
            }
        </script>
    @endpush
@endonce
