export const load = {
    fonts: () => {
        loadFont("Tahoma", "./assets/fonts/tahoma.ttf");
    },
    assets: () => {
        loadSprite("icon", "./assets/images/icon.png");
        loadSprite("bg_menu", "./assets/images/bg_menu.png");
        loadSprite("sky_bg", "./assets/images/sky_bg.png");
        loadSprite("test", "./assets/images/test.png");
        loadSprite("hotbar", "./assets/images/hotbar.png");
        loadSprite("notepad", "./assets/images/notepad.png");
        //1h31min
        loadSprite("grass", "./assets/images/grass_tileset.png");

        loadSprite("player", "./assets/images/player.png", {
            sliceX: 7,
            sliceY: 5,
            anims: {
                idle: {
                    from: 0,
                    to: 1,
                    loop: true,
                    speed: 2,
                },
                run: {
                    from: 2,
                    to: 4,
                    loop: true,
                    speed: 7,
                },
                jump: { from: 0, to: 1, loop: true, speed: 2.5 },
            },
        })

    },
    sounds: () => {
        loadSound("start_windows", "./assets/sfx/windows_start.mp3");
    }
}