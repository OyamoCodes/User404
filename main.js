import kaboom from "https://unpkg.com/kaboom/dist/kaboom.mjs";
import { uiManager } from "./utils/UIManager.js";
import { load } from "./utils/loader.js";
import { level1Layout, level1Mappings } from "./contents/level1/level1Layout.js"
import { level1Config } from "./contents/level1/config.js";
import { Level } from "./utils/level.js"
import { Player } from "./assets/entities/Player.js";
import { attachCamera } from "./utils/Camera.js";
import { uiGuide, showInputBox } from "./utils/UIGuide.js";


kaboom({
    width: 1280,
    height: 720,
    letterbox: true,
    debug: true,
})

debug.inspect = true;

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
        setGravity(3000)
        const level1 = new Level()
        level1.drawBackground("sky_bg")
        addLevel(level1Layout, {
            tileWidth: 64,
            tileHeight: 64,
            tiles: level1Mappings,
        });
        const player = new Player(level1Config.posX, level1Config.posY, level1Config.speed, level1Config.jumpForce, 0, 0);
        attachCamera(player.gameObj, 150, -100);
        uiManager.displayHotbar("grass");
        uiGuide.displayGuidedUI(player.guideProgress)
        onUpdate(() => {
            if (player.inputBox === 1 && !get("notepad_ui").length) {
                showInputBox((text) => {
                    console.log("User typed:", text);
                }, player);
            }
            if (player.inputBox === 0 && get("notepad_ui").length) {
                destroyAll("notepad_ui");
            }

            onKeyPress("m", () => {
                go("menu");
            });

        });
    },
    dragTest: () => {
        const dragTest = new Level()
        dragTest.drawBackground("wood_bg", 2);
    },
    end: () => {
    }
}

for (const key in scenes) {
    scene(key, scenes[key])
}

go("menu")