#!/usr/bin/env node
process.chdir(__dirname)
var CompressJsFiles = require('../../../js/CompressJsFiles.js')
CompressJsFiles([
    'HomeItems',
    'RenderAdmin',
    'RenderBarCharts',
    'RenderNewBarChart',
    'RenderNewBookmark',
    'RenderNewCalculation',
    'RenderNewEvent',
    'RenderNewContact',
    'RenderNewNote',
    'RenderNewPlace',
    'RenderNewSchedule',
    'RenderNewTask',
    'RenderNewWallet',
    'RenderNewTransaction',
    'RenderPostNotification',
    'RenderTransferAmount',
    'RenderTrash',
    'RenderUploadFiles',
    'main',
], '../index.js')
