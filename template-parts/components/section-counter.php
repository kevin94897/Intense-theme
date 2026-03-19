<?php

$stats = [
    [
        'value'    => '2015–2025',
        'label'    => "Tripadvisor Travelers'\nChoice Award",
        'type'     => 'text',  // 'text' | 'number'
    ],
    [
        'value'    => '4.9',
        'suffix'   => '/ 5',
        'label'    => 'Average Rating on Tripadvisor (+550 reviews)',
        'type'     => 'number',
        'decimals' => 1,
    ],
    [
        'value'    => '10000',
        'prefix'   => '+',
        'label'    => 'Satisfied Clients',
        'type'     => 'number',
        'decimals' => 0,
    ],
    [
        'value'    => '50',
        'prefix'   => '+',
        'suffix'   => '%',
        'label'    => 'Women Workforce',
        'type'     => 'number',
        'decimals' => 0,
    ],
    [
        'value'    => '2015–2025',
        'label'    => "Tripadvisor Travelers'\nChoice Award",
        'type'     => 'text',
    ],
];

?>

<section class="stats-bar py-10 bg-cream overflow-hidden">
    <div class="container-site mx-auto px-6 lg:px-8">
        <div class="stats-grid grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-y-10 gap-x-6 lg:gap-x-0">

            <?php foreach ($stats as $i => $stat) :
                $is_last = ($i === count($stats) - 1);
            ?>
                <div
                    class="stat-item flex flex-col items-center text-center
                           <?php echo !$is_last ? '' : ''; ?>
                           px-4 lg:px-8"
                    data-aos="fade-up"
                    data-aos-delay="<?php echo $i * 80; ?>">
                    <?php if ($stat['type'] === 'number') : ?>
                        <!-- Número animado -->
                        <div class="stat-value font-display text-dark text-2xl lg:text-3xl font-normal tracking-tight leading-none mb-2">
                            <span class="stat-prefix"><?php echo esc_html($stat['prefix'] ?? ''); ?></span><span
                                class="stat-count"
                                data-target="<?php echo esc_attr($stat['value']); ?>"
                                data-decimals="<?php echo esc_attr($stat['decimals'] ?? 0); ?>">0</span><span class="stat-suffix"><?php echo esc_html($stat['suffix'] ?? ''); ?></span>
                        </div>
                    <?php else : ?>
                        <!-- Texto estático -->
                        <div class="stat-value font-display text-dark text-2xl lg:text-3xl font-normal tracking-tight leading-none mb-2">
                            <?php echo esc_html($stat['value']); ?>
                        </div>
                    <?php endif; ?>

                    <p class="stat-label font-body text-dark text-md leading-snug">
                        <?php echo nl2br(esc_html($stat['label'])); ?>
                    </p>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>

<script>
    (function() {
        function easeOutQuart(t) {
            return 1 - Math.pow(1 - t, 4);
        }

        function animateCounter(el) {
            const target = parseFloat(el.dataset.target);
            const decimals = parseInt(el.dataset.decimals) || 0;
            const duration = 1800; // ms
            let start = null;

            function step(timestamp) {
                if (!start) start = timestamp;
                const elapsed = timestamp - start;
                const progress = Math.min(elapsed / duration, 1);
                const eased = easeOutQuart(progress);
                const current = eased * target;

                el.textContent = decimals > 0 ?
                    current.toFixed(decimals) :
                    Math.floor(current).toLocaleString('en-US').replace(/,/g, '.');

                if (progress < 1) {
                    requestAnimationFrame(step);
                } else {
                    el.textContent = decimals > 0 ?
                        target.toFixed(decimals) :
                        target.toLocaleString('en-US').replace(/,/g, '.');
                }
            }

            requestAnimationFrame(step);
        }

        // Disparar animación cuando la sección es visible (IntersectionObserver)
        const counters = document.querySelectorAll('.stat-count');
        if (!counters.length) return;

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.4
        });

        counters.forEach(el => observer.observe(el));
    })();
</script>