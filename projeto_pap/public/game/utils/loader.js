export const load = {
    fonts: () => {
        loadFont("Tahoma", "/game/assets/fonts/tahoma.ttf");
    },
    assets: () => {
        loadSprite("icon", "/game/assets/images/icon.png");
        loadSprite("bg_menu", "/game/assets/images/bg_menu.png");
        loadSprite("sky_bg", "/game/assets/images/sky_bg.png");
        loadSprite("test", "/game/assets/images/test.png");
        loadSprite("hotbar", "/game/assets/images/hotbar.png");
        loadSprite("notepad", "/game/assets/images/notepad.png");
        loadSprite("wood_bg", "/game/assets/images/wood_bg.png");
        loadSprite("bonzi", "/game/assets/images/bonzi.gif");
        loadSprite("rubber", "/game/assets/images/rubber.png");
        loadSprite("ram_stick", "/game/assets/images/ram_stick.png");
        loadSprite("motherboard", "/game/assets/images/motherboard.png");
        //1h31min
        loadSprite("grass", "/game/assets/images/grass_tileset.png");

        loadSprite("player", "/game/assets/images/player.png", {
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
        loadSound("start_windows", "/game/assets/sfx/windows_start.mp3");
    }
}