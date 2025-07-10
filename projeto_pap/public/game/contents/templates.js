// templates/programacao.js
import { Level } from "../utils/level.js";
import { Player } from "../assets/entities/Player.js";
import { attachCamera } from "../utils/Camera.js";
import { uiGuide, showInputBox } from "../utils/UIGuide.js";
import { uiManager } from "../utils/UIManager.js";

export function runTemplateProgramacao(levelData) {
    setGravity(3000);

    const level = new Level();
    level.drawBackground("sky_bg", 1);

    addLevel(levelData.layout || [[]], {
        tileWidth: 64,
        tileHeight: 64,
        tiles: levelData.tiles || {},
    });

    const player = new Player(0, 0, 500, 800, 0); 
    attachCamera(player.gameObj, 150, -100);

    uiManager.displayHotbar("grass");
    uiGuide.displayGuidedUI(player.guideProgress);

    onUpdate(() => {
        if (player.inputBox === 1 && !get("notepad_ui").length) {
            showInputBox((text) => {
                console.log("User typed:", text);
            }, player);
        }
        if (player.inputBox === 0 && get("notepad_ui").length) {
            destroyAll("notepad_ui");
        }
    });

    onClick(() => {
        if (player.guideShow === 1) {
            player.guideProgress++;
            uiGuide.updateGuideText(player.guideProgress);
        }
    });

    onKeyPress("m", () => go("menu"));
}
