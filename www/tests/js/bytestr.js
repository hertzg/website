#!/usr/bin/env node

process.chdir(__dirname)
eval(require('fs').readFileSync('../../js/bytestr.js', 'utf8'))
eval(require('fs').readFileSync('../../js/number_format.js', 'utf8'))

console.assert(bytestr(0) === '0 B')
console.assert(bytestr(64) === '64 B')
console.assert(bytestr(512) === '512 B')
console.assert(bytestr(1023) === '1,023 B')
console.assert(bytestr(1024) === '1 KB')
console.assert(bytestr(1024 * 2.5) === '2.5 KB')
console.assert(bytestr(1024 * 1024) === '1 MB')
console.assert(bytestr(1024 * 1024 * 2.5) === '2.5 MB')
console.assert(bytestr(1024 * 1024 * 1024) === '1 GB')
console.assert(bytestr(1024 * 1024 * 1024 * 2.5) === '2.5 GB')
console.assert(bytestr(1024 * 1024 * 1024 * 1024) === '1 TB')
console.assert(bytestr(1024 * 1024 * 1024 * 1024 * 2.5) === '2.5 TB')
