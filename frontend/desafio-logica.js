for (let i = 1; i <= 100; i++) {
  let newValue = i

  if (i % 3 === 0) {
    newValue = 'Co'
  }

  if (i % 5 === 0) {
    newValue = 'Blue'
  }

  if (i % 3 ===0 && i % 5 === 0) {i
    newValue = 'CoBlue'
  }
  console.log(newValue)
}