<div id="preloader" class="is-active"></div>
@once
    @push('scripts')
        <script type="text/javascript">
            const preloader = document.querySelector('#preloader')
            window.addEventListener('DOMContentLoaded', () => {
                preloader.classList.remove('is-active')
            })
        </script>
    @endpush
@endonce
