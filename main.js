import kaboom from "https://unpkg.com/kaboom/dist/kaboom.mjs";
import { uiManager } from "./utils/UIManager.js";
import { load } from "./utils/loader.js";
import { level1Layout, level1Mappings } from "./contents/level1/level1Layout.js"
import { Level } from "./utils/level.js"

kaboom({
    width: 1280, 
    height: 720,
    letterbox:true
})

load.fonts()
load.sounds()
load.assets()

const scenes = {
    menu: ()=>{
        uiManager.displayMainMenu()
    },
    controls: ()=>{
        uiManager.displayControls()
    },
    1: ()=>{
        const level1= new Level()
        level1.drawBackground("sky_bg");
        level1.drawMapLayout(level1Layout, level1Mappings);
    },
    2: ()=>{
        const level2 = new Level()
    },
    3: ()=>{
    },
    end: ()=>{
    }
}

for (const key in scenes) {
    scene(key, scenes[key])
}

go("menu")