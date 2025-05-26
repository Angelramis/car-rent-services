    </main>
    <footer class="flex flex-row flex-wrap items-center gap-2 bg-[#1389e4] w-full h-auto md:h-[52px] p-[10px]">
      <p class="text-white">© Car Rent Services</p>
      <a class="text-white" href=""><?= __('Privacy policy', $lang); ?></a>
      <a class="text-white" href=""><?= __('Legal Notice', $lang); ?></a>
      <a class="text-white" href=""><?= __('Cookies Policy', $lang); ?></a>
      <a href="/car-rent-services/views/manuals/manual-user.php" class="text-white">User manual</a>
    </footer>

    <script src="/car-rent-services/js/functions.js"></script>
    <script>
      function setLang(lang) {
        window.location.href = `/car-rent-services/index.php?lang=${lang}`;
      }
    </script>
    </body>

    </html>