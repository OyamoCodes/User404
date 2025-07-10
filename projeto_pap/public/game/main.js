import { uiManager } from "./utils/UIManager.js";
import { load } from "./utils/loader.js";
import { level1Layout, level1Mappings } from "./contents/level1/level1Layout.js"
import { level1Config } from "./contents/level1/config.js";
import { Level } from "./utils/level.js"
import { Player } from "./assets/entities/Player.js";
import { attachCamera } from "./utils/Camera.js";
import { uiGuide, showInputBox } from "./utils/UIGuide.js";
import { startDragTest } from "./contents/drag/drag.js";

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
let gameData = {};

document.addEventListener("DOMContentLoaded", () => {
    const gameElement = document.getElementById("game");
    if (!gameElement) {
        console.error("Elemento #game não encontrado no DOM");
        return;
    }

    try {
        gameData = JSON.parse(gameElement.dataset.template);
        console.log("Dados do jogo:", gameData);
    } catch (err) {
        console.error("Erro ao fazer parse do JSON do jogo:", err);
    }
});


const scenes = {
    menu: () => {
        if (!gameData) {
            console.error("gameData não inicializado");
            return;
        }
        const title = gameData.title || "Título padrão";
        uiManager.displayMainMenu(title);
    },
    controls: () => {
        uiManager.displayControls()
    },
    1: () => {
        if (!gameData || !gameData.levels || gameData.levels.length === 0) {
            console.warn("Dados do jogo não estão disponíveis ou não existem níveis.");
            return;
        }

        const currentLevel = gameData.levels[0];

        if (currentLevel.template_id === 1) {
            console.log("Template de programação detectado. Dados do nível:");
            console.log(currentLevel);
        } else {
            console.log("Template não é de programação. Ignorado.");
        }

        // Se houver diálogos, mostra antes de iniciar o nível
        if (currentLevel.dialogues && currentLevel.dialogues.length > 0) {
            const orderedDialogues = [...currentLevel.dialogues].sort((a, b) => a.order - b.order);

            playDialogues(orderedDialogues, () => {
                // Só inicia o jogo depois dos diálogos
                const level = setupLevelEnvironment();
                const player = createPlayer();
                setupLevelUI(player);
                handleLevelEvents(player);
            });

            return; // Espera terminar os diálogos
        }

        // Se não houver diálogos, continua normalmente
        const level = setupLevelEnvironment();
        const player = createPlayer();
        setupLevelUI(player);
        handleLevelEvents(player);
    },
    dragTest: () => {
        const dragTest = new Level()
        startDragTest();
    },

    about: () => {
        uiManager.displayAbout()
    },
    end: () => {
    }
}

for (const key in scenes) {
    scene(key, scenes[key])
}

document.addEventListener("DOMContentLoaded", () => {
    const gameElement = document.getElementById("game");
    if (!gameElement) {
        console.error("Elemento #game não encontrado no DOM");
        return;
    }

    try {
        gameData = JSON.parse(gameElement.dataset.template);
        console.log("✅ Dados do jogo carregados:", gameData);

        go("menu"); // <-- só chamamos aqui depois de gameData estar pronto
    } catch (err) {
        console.error("Erro ao fazer parse do JSON do jogo:", err);
    }
});


function createPlayer() {
    const player = new Player(
        level1Config.posX,
        level1Config.posY,
        level1Config.speed,
        level1Config.jumpForce,
        0
    );
    attachCamera(player.gameObj, 150, -100);
    return player;
}
function setupLevelEnvironment() {
    setGravity(3000);

    const level = new Level();
    level.drawBackground("sky_bg", 1);

    addLevel(level1Layout, {
        tileWidth: 64,
        tileHeight: 64,
        tiles: level1Mappings,
    });

    return level;
}

function setupLevelUI(player) {
    uiManager.displayHotbar("grass");

    if (player.guideProgress === 0) {
        uiGuide.displayGuidedUI(player.guideProgress);
    }
}

function handleLevelEvents(player) {
    onUpdate(() => {
        // input box toggle
        const inputBoxExists = get("notepad_ui").length;

        if (player.inputBox === 1 && !inputBoxExists) {
            showInputBox((text) => {
                console.log("User typed:", text);
            }, player);
        }

        if (player.inputBox === 0 && inputBoxExists) {
            destroyAll("notepad_ui");
        }
    });

    onClick(() => {
        if (player.guideShow === 1) {
            player.guideProgress++;
            uiGuide.updateGuideText(player.guideProgress);
            console.log("Progresso:", player.guideProgress);
        }
    });

    onKeyPress("m", () => {
        go("menu");
    });
}
function playDialogues(dialogues, onFinish) {
    let index = 0;

    function showNext() {
        if (index >= dialogues.length) {
            if (onFinish) onFinish();
            // Remove o event listener para evitar múltiplos clicks após o fim
            onClick(() => { }); // Remove listener anterior (alternativa simples)
            return;
        }

        const d = dialogues[index];
        uiGuide.showDialogue(d.speaker || "???", d.text);

        index++;
    }
    showNext();
    onClick(() => {
        if (index < dialogues.length) {
            showNext();
        } else {
            if (onFinish) onFinish();
            onClick(() => { }); 
        }
    });
}

