import kaboom from "https://unpkg.com/kaboom/dist/kaboom.mjs";
import { uiManager } from "./utils/UIManager.js";
import { load } from "./utils/loader.js";
import { level1Layout, level1Mappings } from "./contents/level1/level1Layout.js"
import { Level } from "./utils/level.js"
import { Player } from "./assets/entities/Player.js";
import { attachCamera } from "./utils/Camera.js";

kaboom({
    width: 1280,
    height: 720,
    letterbox: true
})

load.fonts()
load.sounds()
load.assets()

const scenes = {
    menu: () => {
        uiManager.displayMainMenu()
    },
    controls: () => {
        uiManager.displayControls()
    },
    1: () => {
        setGravity(2000)
        const level1 = new Level()
        level1.drawBackground("sky_bg", scale(0.2))
        addLevel(level1Layout, {
            tileWidth: 32,
            tileHeight: 32,
            tiles: level1Mappings,
        });
        const player = new Player(200, -150, 400, 650, 1, false)
        attachCamera(player.gameObj, 0, -100);
    },
    2: () => {
    },
    3: () => {
    },
    end: () => {
    }
}

for (const key in scenes) {
    scene(key, scenes[key])
}

go("menu")