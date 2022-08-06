<template>
    <section class="section-fullscreen mb-10">
        <div>
            <!-- background: {
                        color: {
                            value: '#0d47a1',
                        },
                    }, -->
            <!-- <Particles
                id="tsparticles"
                :particlesInit="particlesInit"
                :particlesLoaded="particlesLoaded"
                :options="{
                    fpsLimit: 160,
                    fullScreen: false,
                    interactivity: {
                        detectsOn: 'window',
                        events: {
                            onClick: {
                                enable: false,
                            },
                            onHover: {
                                enable: false,
                                mode: 'repulse',
                                parallax: {
                                    enable: false,
                                    force: 60,
                                    smooth: 10,
                                    origin: 'mouse',
                                },
                            },
                            resize: false,
                        },
                    },
                    particles: {
                        color: {
                            value: '#ffffff',
                        },
                        links: {
                            color: '#e74a23',
                            distance: 200,
                            enable: true,
                            opacity: 0.9,
                            width: 2,
                        },
                        collisions: {
                            enable: true,
                        },
                        move: {
                            direction: 'none',
                            enable: true,
                            outMode: 'absorb',
                            random: false,
                            speed: 1,
                            straight: false,
                        },
                        number: {
                            density: {
                                enable: true,
                                area: 1000,
                            },
                            value: 35,
                        },
                        opacity: {
                            value: 1,
                        },
                        shape: {
                            type: 'image',
                            polygon: {
                                slides: 5,
                            },
                            star: {
                                slides: 5,
                            },
                            image: [
                                {
                                    src: '/img/logos_ensa/ENSA-Agadir.webp',
                                    width: 100,
                                    height: 100,
                                },
                                {
                                    src: '/img/logos_ensa/ENSA-Beni-mellal.webp',
                                    width: 100,
                                    height: 100,
                                },
                                {
                                    src: '/img/logos_ensa/ENSA-Berrechid.webp',
                                    width: 100,
                                    height: 100,
                                },
                                {
                                    src: '/img/logos_ensa/ENSA-El-jadida.webp',
                                    width: 100,
                                    height: 100,
                                },
                                {
                                    src: '/img/logos_ensa/ENSA-Fès.webp',
                                    width: 100,
                                    height: 100,
                                },
                                {
                                    src: '/img/logos_ensa/ENSA-Houcima.webp',
                                    width: 100,
                                    height: 100,
                                },
                                {
                                    src: '/img/logos_ensa/ENSA-Kénitra.webp',
                                    width: 100,
                                    height: 100,
                                },
                                {
                                    src: '/img/logos_ensa/ENSA-Khouribga.webp',
                                    width: 100,
                                    height: 100,
                                },
                                {
                                    src: '/img/logos_ensa/ENSA-Marrakech.webp',
                                    width: 100,
                                    height: 100,
                                },
                                {
                                    src: '/img/logos_ensa/ENSA-Oujda.webp',
                                    width: 100,
                                    height: 100,
                                },
                                {
                                    src: '/img/logos_ensa/ENSA-Safi.webp',
                                    width: 100,
                                    height: 100,
                                },
                                {
                                    src: '/img/logos_ensa/ENSA-Tanger.webp',
                                    width: 100,
                                    height: 100,
                                },
                                {
                                    src: '/img/logos_ensa/ENSA-Tétouane.webp',
                                    width: 100,
                                    height: 100,
                                },
                            ],
                        },
                        size: {
                            random: true,
                            value: 50,
                        },
                    },
                    detectRetina: true,
                }"
            /> -->
            <div class="bubble-wrap">
                <div class="bubbles"></div>
            </div>
        </div>
    </section>
</template>
<script>
export default {
    name: "Header",
    data() {
        return {};
    },
    mounted() {
        const bubbles = [
            { s: 0.6, x: 1134, y: 45 },
            { s: 0.6, x: 1620, y: 271 },
            { s: 0.6, x: 1761, y: 372 },
            { s: 0.6, x: 2499, y: 79 },
            { s: 0.6, x: 2704, y: 334 },
            { s: 0.6, x: 2271, y: 356 },
            { s: 0.6, x: 795, y: 226 },
            { s: 0.6, x: 276, y: 256 },
            { s: 0.6, x: 1210, y: 365 },
            { s: 0.6, x: 444, y: 193 },
            { s: 0.6, x: 2545, y: 387 },
            { s: 0.8, x: 1303, y: 193 },
            { s: 0.8, x: 907, y: 88 },
            { s: 0.8, x: 633, y: 320 },
            { s: 0.8, x: 323, y: 60 },
            { s: 0.8, x: 129, y: 357 },
            { s: 0.8, x: 1440, y: 342 },
            { s: 0.8, x: 1929, y: 293 },
            { s: 0.8, x: 2135, y: 198 },
            { s: 0.8, x: 2276, y: 82 },
            { s: 0.8, x: 2654, y: 182 },
            { s: 0.8, x: 2783, y: 60 },
            { x: 1519, y: 118 },
            { x: 1071, y: 233 },
            { x: 1773, y: 148 },
            { x: 2098, y: 385 },
            { x: 2423, y: 244 },
            { x: 901, y: 385 },
            { x: 624, y: 111 },
            { x: 75, y: 103 },
            { x: 413, y: 367 },
            { x: 2895, y: 271 },
            { x: 1990, y: 75 },
        ];

        const bubblesEl = document.querySelector(".bubbles");

        bubbles.forEach((bubble, index) => {
            if (!bubble.s) bubble.s = 1;
            let el = document.createElement("div");

            el.className = `bubble logo${index + 1}`;
            el.style.transform = `translate(${bubble.x}px, ${bubble.y}px) scale(${bubble.s})`;

            bubblesEl.appendChild(el);
        });
    },
};
</script>
