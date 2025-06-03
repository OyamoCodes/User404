export const load = {
    fonts: () => {
        loadFont("Tahoma", "./assets/fonts/tahoma.ttf");
    },
    assets: () => {
        loadSprite("icon", "./assets/images/icon.png");
        loadSprite("bg_menu", "./assets/images/bg_menu.png");
        loadSprite("sky_bg", "./assets/images/sky_bg.png");
        loadSprite("test", "./assets/images/test.png");
        //1h31min
        loadSprite("grass-tileset", "./assets/images/grass_tileset.png", {
            sliceX: 3,
            sliceY: 3,
            anims: {
                tl: 0,
                tm: 1,
                tr: 2,
                ml: 3,
                mm: 4,
                mr: 5,
                bl: 6,
                bm: 7,
                br: 8,
            },
        });
    },
    sounds: () => {
        loadSound("start_windows", "./assets/sfx/windows_start.mp3");
    }
}