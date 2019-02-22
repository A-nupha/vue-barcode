import Quagga from 'quagga';

Quagga.init({
  inputStream: {
    name: 'Live',
    type: 'LiveStream',
    target: document.querySelector('#yourElement'), // Or '#yourElement' (optional)
  },
  decoder: {
    readers: ['code_128_reader'],
  },
}, (err) => {
  if (err) {
    console.log(err);
    return
  }
  console.log('Initialization finished. Ready to start');
  Quagga.start();
});

export default Quagga.init
