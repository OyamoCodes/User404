export function checkInputBox(inputText, player) {
  const requiredParts = inputBoxChecker.printf.slice(1); // [';', '"', 'printf']
  const missingParts = requiredParts.filter(part => !inputText.includes(part));

  if (inputText === inputBoxChecker.printf[0]) {
    console.log("Input box check passed!");
    player.inputBox = 0;
  } else if (inputText === 'itsme') {
    console.log("Hi me! Input box check passed!");
    player.inputBox = 0;
  } else {
    console.log("Input box check failed. Tenta de novo.");
  }
}


export const inputBoxChecker = {
  printf: [
    'printf("");',
    ';',
    '""',
    'printf',
  ],

};
