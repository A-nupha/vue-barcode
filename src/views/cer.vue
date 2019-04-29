<template>
  <v-btn color="blue" class="white--text" @click="print">report</v-btn>
</template>
<script>
import pdfmakeCustom from '@cdglib/js-pdfmake-custom/src/plugin/pdfmake-custom';
import printDoc from '@cdglib/js-pdfmake-custom/src/pdf/print';

export default {
  name: 'Pdf',
  data() {
    return {
      data: {
        detail: [
          {
            date: '12/06/2562',
            code: '2423423423523',
            name: 'sss1 ssss ssss',
            count_in: '10',
            count_out: '104',
            invert: '100',
            profit: '10',
            balance: '20',
            lost: '2',
            other: 'eqw',
          },
          {
            date: '12/06/2562',
            code: '234234234234235',
            name: 'sss1 ssss ',
            count_in: '41',
            count_out: '411',
            invert: '200',
            profit: '12',
            balance: '2222',
            lost: '1',
            other: 'eqw',
          },
          {
            date: '14/06/2562',
            code: '5345345345345',
            name: 'sss ssss',
            count_in: '51',
            count_out: '777',
            invert: '212122',
            profit: '122',
            balance: '2211',
            lost: '21',
            other: 'eqw',
          },
          {
            date: '14/06/2562',
            code: '4234234234234',
            name: ' sss',
            count_in: '11',
            count_out: '77',
            invert: '2121',
            profit: '1',
            balance: '21',
            lost: '212',
            other: 'eqw',
          },
          {
            date: '14/06/2562',
            code: '523523423432423',
            name: 'sss1 rwe ssss',
            count_in: '10',
            count_out: '89',
            invert: '231',
            profit: '1',
            balance: '1232',
            lost: '213',
            other: 'eqw',
          },
          {
            date: '18/06/2562',
            code: '4234252523523',
            name: 'werwer ssss ssss',
            count_in: '81',
            count_out: '778',
            invert: '123',
            profit: '1',
            balance: '1223',
            lost: '323',
            other: 'eqw',
          },
          {
            date: '18/06/2562',
            code: '5235355235423',
            name: 'sss1 ssss rwer',
            count_in: '1',
            count_out: '0',
            invert: '3213',
            profit: '1',
            balance: '3213',
            lost: '213',
            other: 'eqw',
          },
          {
            date: '18/06/2562',
            code: '534534523',
            name: 'sss1 ss342ss ssss',
            count_in: '1',
            count_out: '878',
            invert: '3213',
            profit: '1',
            balance: '3312',
            lost: '3213',
            other: 'eqw',
          },
          {
            date: '18/06/2562',
            code: '423423423',
            name: '34234 ssss ssss',
            count_in: '91',
            count_out: '778',
            invert: '213',
            profit: '1',
            balance: '32131',
            lost: '213',
            other: 'eqw',
          },
          {
            date: '18/10/2562',
            code: '3213213213',
            name: 'sss1 34234 ssss',
            count_in: '32',
            count_out: '92',
            invert: '3213',
            profit: '1',
            balance: '3213',
            lost: '321',
            other: 'eqw',
          },
          {
            date: '18/10/2562',
            code: '73010477988',
            name: '2312 ssss ssss',
            count_in: '12',
            count_out: '145',
            invert: '213',
            profit: '1',
            balance: '3213',
            lost: '3213',
            other: 'eqw',
          },
          {
            date: '18/06/2562',
            code: '5235355235423',
            name: 'sss1 ssss rwer',
            count_in: '1',
            count_out: '0',
            invert: '3213',
            profit: '1',
            balance: '3213',
            lost: '213',
            other: 'eqw',
          },
          {
            date: '18/06/2562',
            code: '534534523',
            name: 'sss1 ss342ss ssss',
            count_in: '1',
            count_out: '878',
            invert: '3213',
            profit: '1',
            balance: '3312',
            lost: '3213',
            other: 'eqw',
          },
          {
            date: '18/06/2562',
            code: '423423423',
            name: '34234 ssss ssss',
            count_in: '91',
            count_out: '778',
            invert: '213',
            profit: '1',
            balance: '32131',
            lost: '213',
            other: 'eqw',
          },
          {
            date: '18/10/2562',
            code: '3213213213',
            name: 'sss1 34234 ssss',
            count_in: '32',
            count_out: '92',
            invert: '3213',
            profit: '1',
            balance: '3213',
            lost: '321',
            other: 'eqw',
          },
          {
            date: '18/10/2562',
            code: '73010477988',
            name: '2312 ssss ssss',
            count_in: '12',
            count_out: '145',
            invert: '213',
            profit: '1',
            balance: '3213',
            lost: '3213',
            other: 'eqw',
          },
        ],
      },
    }
  },
  methods: {
    createID1(data) {
      this.index = 0
      const formatBody = data
        .map(d => ({
          date: `${d.date}`,
          code: `${d.code}`,
          name: `${d.name}`,
          count_in: `${d.count_in}`,
          count_out: `${d.count_out}`,
          invert: `${d.invert}`,
          profit: `${d.profit}`,
          balance: `${d.balance}`,
          lost: `${d.lost}`,
          other: `${d.other}`,
        }))
      const body = formatBody.map(f => ({
        style: 'content',
        table: {
          widths: [50, 90, 80, 50, 50, 50, 80, 70, 70, '*'],
          body: [
            [
              { text: `${f.date}`, alignment: 'center', border: [true, true, true, false] },
              { text: `${f.code}`, alignment: 'center', border: [true, true, true, false] },
              { text: `${f.name}`, alignment: 'center', border: [true, true, true, false] },
              { text: `${f.count_in}`, alignment: 'center', border: [true, true, true, false] },
              { text: `${f.count_out}`, alignment: 'center', border: [true, true, true, false] },
              { text: `${f.invert}`, alignment: 'center', border: [true, true, true, false] },
              { text: `${f.profit}`, alignment: 'center', border: [true, true, true, false] },
              { text: `${f.balance}`, alignment: 'center', border: [true, true, true, false] },
              { text: `${f.lost}`, alignment: 'center', border: [true, true, true, false] },
              { text: `${f.other}`, alignment: 'center', border: [true, true, true, false] },
            ],
          ],
        },
      }))
      return {
        body,
      }
    },
    // empty line
    space() {
      let body = []
      const a = {
        style: 'content',
        table: {
          widths: [50, 90, 80, 50, 50, 50, 80, 70, 70, '*'],
          body: [
            [
              { text: ' ', alignment: 'center', border: [true, true, true, false] },
              { text: '', alignment: 'center', border: [true, true, true, false] },
              { text: '', alignment: 'center', border: [true, true, true, false] },
              { text: '', alignment: 'center', border: [true, true, true, false] },
              { text: '', alignment: 'center', border: [true, true, true, false] },
              { text: '', alignment: 'center', border: [true, true, true, false] },
              { text: '', alignment: 'center', border: [true, true, true, false] },
              { text: '', alignment: 'center', border: [true, true, true, false] },
              { text: '', alignment: 'center', border: [true, true, true, false] },
              { text: '', alignment: 'center', border: [true, true, true, false] },
            ],
          ],
        },
      }
      for (let i = 0; i < 3; i +=1) {
        body.push(a)
      }
      
      return { body }
    },
    async print() {
      const layout1 = {
        info: {
          title: 'filename',
          author: 'Core Solutions Co.,Ltd.',
          subject: 'subject of document',
          keywords: 'keywords for document',
        },
        content: [
          {
            style: 'header',
            text: [
              'รายการสินค้า เข้าออกประจำวันที่ 01/01/2562 - 31/01/2562 \n',
            ],
            bold: true,
          },
          {
            style: 'content',
            text: [
              '\nมูลค่ารวมของสินค้าคงคลัง 4649.00 บาท รายการสินค้าคงคลัง 2\n\n',
            ],
          },

          {
            style: 'content',
            table: {
              widths: [50, 90, 80, 50, 50, 50, 80, 70, 70, '*'],
              body: [
                [
                  { text: 'วันที่', alignment: 'center', border: [true, true, true, false] },
                  { text: 'รหัสสินค้า', alignment: 'center', border: [true, true, true, false] },
                  { text: 'ชื่อสินค้า', alignment: 'center', border: [true, true, true, false] },
                  { text: 'สินค้าเข้า', alignment: 'center', border: [true, true, true, false] },
                  { text: 'สินค้าออก', alignment: 'center', border: [true, true, true, false] },
                  { text: 'เงินทุน', alignment: 'center', border: [true, true, true, false] },
                  { text: 'เงินจากการขาย', alignment: 'center', border: [true, true, true, false] },
                  { text: 'มูลค้าสินค้าคงคลัง', alignment: 'center', border: [true, true, true, false] },
                  { text: 'สินค้าเสียหาย', alignment: 'center', border: [true, true, true, false] },
                  { text: 'สินค้าถูกจำหน่ายด้วยประเภทอื่น', alignment: 'center', border: [true, true, true, false] },
                ],
              ],
            },
            bold: true,
            layout: {
              defaultBorder: false,
            },
          },
          ...this.createID1(this.data.detail).body,
          ...this.space().body, // empty line

          // Footer
          {
            style: 'content',
            table: {
              widths: [50, 90, 80, 50, 50, 50, 80, 70, 70, '*'],
              body: [
                [
                  { text: 'รายการชำรุด/สูญหาย', alignment: 'left', border: [true, true, true, false], colSpan: 8 },
                  { text: '', alignment: 'left', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '20', alignment: 'center', border: [true, true, true, false] },
                  { text: '500', alignment: 'center', border: [true, true, true, false] },
                ],
              ],
            },
            layout: {
              defaultBorder: true,
            },
          },
          {
            style: 'content',
            table: {
              widths: [50, 90, 80, 50, 50, 50, 80, 70, 70, '*'],
              body: [
                [
                  { text: 'รายได้', alignment: 'left', border: [true, true, true, false], colSpan: 8, },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '10', alignment: 'center', border: [true, true, true, false] },
                  { text: '100000', alignment: 'center', border: [true, true, true, false] },
                ],
              ],
            },
            layout: {
              defaultBorder: true,
            },
          },
          {
            style: 'content',
            table: {
              widths: [50, 90, 80, 50, 50, 50, 80, 70, 70, '*'],
              body: [
                [
                  { text: 'รวมทั้งสิ้น 2 รายการ', alignment: 'left', border: [true, true, true, false], colSpan: 8, },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '30', alignment: 'center', border: [true, true, true, false] },
                  { text: '55555', alignment: 'center', border: [true, true, true, false] },
                ],
              ],
            },
            layout: {
              defaultBorder: true,
            },
          },
          {
            style: 'content',
            table: {
              widths: [50, 90, 80, 50, 50, 50, 80, 70, 70, '*'],
              body: [
                [
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                  { text: '', alignment: 'center', border: [false, true, false, false] },
                ],
              ],
            },
            layout: {
              defaultBorder: true,
            },
          },
        ],
        styles: {
          header: {
            fontSize: 16,
            alignment: 'center',
          },
          content: {
            fontSize: 12,
            alignment: 'left',
          },
        },
      }
      const option = {
        orientation: 'landscape',
        margin: [20, 35, 20, 20],
        font: this.font,
      }
      const pdf = await pdfmakeCustom.pdfMake.createPdfToDataUrl(layout1, option)
      printDoc(pdf)
    },
  },
}
</script>
