export const load = {
    fonts: ( ) => {
        loadFont("Tahoma", "./assets/fonts/tahoma.ttf");
    },
    assets: ( ) => {
        loadSprite("icon", "./assets/images/icon.png");
        loadSprite("bg_menu", "./assets/images/bg.png");
        loadSprite("test", "./assets/images/test.png");
        //1h31min
        loadSprite("grass-tileset", "./assets/images/grass-tileset.png",{
            sliceX: 1,
            sliceY: 1,
        });
    },
    sounds: () => {
        loadSound("start_windows", "./assets/sfx/windows_start.mp3");
    }
}