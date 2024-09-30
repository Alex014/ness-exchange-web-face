    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- jQuery script for light/dark mode toggle -->
    <script src="/js/darkmode.js"></script>

    <?php if (!isset($_COOKIE['darkmode']) || (1 == $_COOKIE['darkmode'])) : ?>
        <script type="text/javascript">
            $(document).ready(function() {
                $(".toggle-icon").trigger("click")
            })
        </script>
    <?php endif; ?>

</body>

</html>