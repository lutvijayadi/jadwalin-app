const puppeteer = require('puppeteer');

app.get('/jadwal/:id/pdf', async (req, res) => {
  const browser = await puppeteer.launch();
  const page = await browser.newPage();
  // render URL halaman cetak yang sudah ada di server
  await page.goto(`http://localhost:3000/jadwal/${req.params.id}/print`, { waitUntil: 'networkidle0' });
  const pdfBuffer = await page.pdf({ format: 'A4', margin: {top:'20mm', bottom:'20mm'} });
  await browser.close();
  res.set({
    'Content-Type': 'application/pdf',
    'Content-Disposition': `attachment; filename=jadwal-${req.params.id}.pdf`,
  });
  res.send(pdfBuffer);
});
