import kaboom from "https://unpkg.com/kaboom/dist/kaboom.mjs";
import { uiManager } from "./utils/UIManager.js";
import { load } from "./utils/loader.js";
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
    },
    2: ()=>{
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