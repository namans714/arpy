<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Solar Calculator — Volt UI</title>
  <style>
    :root {
      /* Brand palette */
      --orange: #ffa101;
      --blue-d: #234ca5;
      --blue-l: #00adef;
      --green-d: #40b449;
      --green-l: #7ac042;
      --logo: #192b53;

      /* Neons */
      --ink: #e7f2ff;
      --muted: #a8b7d4;
      --line: rgba(255, 255, 255, .08);
      --glass: rgba(11, 15, 28, .55);
      --glass2: rgba(20, 26, 48, .65);
      --shadow: 0 30px 60px rgba(0, 0, 0, .45), 0 2px 12px rgba(0, 0, 0, .35);
      --radius: 18px;
    }

    * {
      box-sizing: border-box
    }

    html,
    body {
      height: 100%
    }

    body {
      margin: 0;
      color: var(--ink);
      font: 15.5px/1.6 Inter, ui-sans-serif, system-ui, Segoe UI, Roboto, Arial;
      background: #05070f;
      /* Animated grid + aurora */
      background-image:
        radial-gradient(800px 400px at 80% -10%, rgba(0, 173, 239, .25), transparent 60%),
        radial-gradient(900px 500px at 20% 120%, rgba(64, 180, 73, .22), transparent 60%),
        linear-gradient(180deg, #05070f 0%, #070b14 60%, #060812 100%);
      overflow-x: hidden;
    }

    /* moving grid lines */
    .grid-anim::before,
    .grid-anim::after {
      content: "";
      position: fixed;
      inset: -200vmax;
      pointer-events: none;
      z-index: 0;
      opacity: .22
    }

    .grid-anim::before {
      background: repeating-linear-gradient(90deg, rgba(0, 173, 239, .22) 0 1px, transparent 1px 70px);
      animation: gridX 22s linear infinite
    }

    .grid-anim::after {
      background: repeating-linear-gradient(0deg, rgba(64, 180, 73, .22) 0 1px, transparent 1px 70px);
      animation: gridY 28s linear infinite
    }

    @keyframes gridX {
      to {
        transform: translateX(70px)
      }
    }

    @keyframes gridY {
      to {
        transform: translateY(70px)
      }
    }

    .wrap {
      position: relative;
      z-index: 1;
      max-width: 1200px;
      margin: 0 auto;
      padding: 28px
    }

    /* Header */
    .hero {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      margin-bottom: 18px
    }

    .title {
      display: flex;
      align-items: center;
      gap: 14px
    }

    .mark {
      width: 46px;
      height: 46px;
      border-radius: 12px;
      position: relative;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0, 173, 239, .45)
    }

    .mark::before {
      content: "";
      position: absolute;
      inset: -30%;
      background: conic-gradient(from 0deg, var(--blue-d), var(--blue-l), var(--green-l), var(--green-d), var(--orange), var(--blue-d));
      filter: blur(8px)
    }

    h1 {
      margin: 0;
      font-weight: 900;
      font-size: 26px;
      letter-spacing: .2px;
      color: #e9f1ff
    }

    .sub {
      font-size: 12px;
      color: var(--muted)
    }

    .chip {
      display: inline-flex;
      gap: 8px;
      align-items: center;
      padding: 8px 12px;
      border: 1px solid var(--line);
      border-radius: 999px;
      background: linear-gradient(180deg, rgba(255, 255, 255, .06), rgba(255, 255, 255, .02));
      backdrop-filter: blur(10px)
    }

    .logoText {
      font-weight: 900;
      color: var(--logo)
    }

    /* Layout */
    .grid {
      display: grid;
      grid-template-columns: 340px 1fr;
      gap: 18px
    }

    @media (max-width:1024px) {
      .grid {
        grid-template-columns: 1fr
      }
    }

    /* Cards */
    .card {
      background: var(--glass);
      border: 1px solid var(--line);
      border-radius: var(--radius);
      box-shadow: var(--shadow)
    }

    .card-h {
      padding: 16px 16px 0
    }

    .card-b {
      padding: 18px
    }

    /* Tabs */
    .segs {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 8px;
      border: 1px solid var(--line);
      padding: 6px;
      border-radius: 14px;
      background: linear-gradient(180deg, rgba(255, 255, 255, .06), rgba(255, 255, 255, .02))
    }

    .seg {
      border: 0;
      background: transparent;
      padding: 10px 12px;
      border-radius: 12px;
      font-weight: 800;
      color: #d9ebff;
      cursor: pointer;
      opacity: .75;
      transition: .25s
    }

    .seg:hover {
      opacity: 1;
      transform: translateY(-1px)
    }

    .seg.active {
      opacity: 1;
      background: linear-gradient(90deg, var(--blue-l), var(--green-l));
      color: #03121a;
      box-shadow: inset 0 0 0 1px rgba(255, 255, 255, .08)
    }

    /* Inputs */
    label {
      display: flex;
      justify-content: space-between;
      gap: 8px;
      font-weight: 800;
      margin: 10px 0 6px
    }

    small.hint {
      font-size: 12px;
      color: var(--muted)
    }

    .inp,
    select {
      width: 100%;
      padding: 12px;
      border: 1px solid var(--line);
      border-radius: 12px;
      background: var(--glass2);
      color: var(--ink);
      font: inherit;
      box-shadow: inset 0 0 0 1px rgba(255, 255, 255, .03)
    }

    .row {
      display: grid;
      grid-template-columns: 1fr;
      gap: 12px
    }

    .row2 {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px
    }

    @media (max-width:720px) {
      .row2 {
        grid-template-columns: 1fr
      }
    }

    .range {
      appearance: none;
      width: 100%;
      height: 8px;
      border-radius: 999px;
      background: rgba(255, 255, 255, .06);
      border: 1px solid var(--line);
      overflow: hidden
    }

    .range::-webkit-slider-thumb {
      appearance: none;
      width: 18px;
      height: 18px;
      border-radius: 50%;
      background: #fff;
      box-shadow: 0 1px 8px rgba(0, 0, 0, .5)
    }

    .range::-moz-range-thumb {
      width: 18px;
      height: 18px;
      border: 0;
      border-radius: 50%;
      background: #fff
    }

    .cta {
      display: inline-flex;
      gap: 10px;
      align-items: center;
      padding: 12px 14px;
      border-radius: 12px;
      border: 1px solid rgba(0, 173, 239, .4);
      background: linear-gradient(90deg, var(--blue-l), var(--green-l));
      font-weight: 900;
      color: #02131a;
      cursor: pointer;
      box-shadow: 0 8px 26px rgba(0, 173, 239, .25)
    }

    /* RIGHT dashboard */
    .dash {
      border: 1px dashed rgba(255, 255, 255, .18);
      border-radius: 16px;
      padding: 16px;
      background: linear-gradient(180deg, rgba(255, 255, 255, .05), rgba(255, 255, 255, .02))
    }

    .top {
      display: grid;
      grid-template-columns: 1.1fr .9fr .9fr;
      gap: 16px;
      align-items: center
    }

    @media (max-width:1024px) {
      .top {
        grid-template-columns: 1fr
      }
    }

    /* Ring gauge */
    .ring {
      --p: 0%;
      width: 170px;
      height: 170px;
      border-radius: 50%;
      position: relative;
      background:
        radial-gradient(closest-side, #080e1c 73%, transparent 74 100%),
        conic-gradient(var(--orange) var(--p), rgba(255, 255, 255, .09) 0);
      box-shadow: 0 20px 60px rgba(255, 161, 1, .12), inset 0 0 40px rgba(255, 255, 255, .03);
    }

    .ring::before {
      content: "";
      position: absolute;
      inset: 14px;
      border-radius: 50%;
      background: linear-gradient(180deg, #0b1326, #060c19);
      border: 1px solid var(--line)
    }

    .ring span {
      position: absolute;
      inset: 0;
      display: grid;
      place-items: center;
      font-weight: 900;
      font-size: 24px;
      color: #eaf7ff
    }

    .mini {
      font-size: 12px;
      color: #bcd3f1
    }

    .stacks {
      display: flex;
      gap: 36px;
      justify-content: center
    }

    .pile {
      display: flex;
      flex-direction: column;
      align-items: center
    }

    .pile .num {
      font-weight: 900
    }

    .pile .lbl {
      color: #c6dbfb;
      font-size: 13px
    }

    .save h3 {
      margin: 0;
      text-align: right;
      font-size: 22px
    }

    .save .pct {
      color: #7dd3fc
    }

    .rowKPI {
      margin-top: 14px;
      padding-top: 14px;
      border-top: 1px dashed rgba(255, 255, 255, .18);
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 12px
    }

    @media (max-width:1024px) {
      .rowKPI {
        grid-template-columns: 1fr 1fr
      }
    }

    .kpi {
      display: flex;
      gap: 10px;
      align-items: center
    }

    .kpi .ico {
      font-size: 22px
    }

    .kpi .v {
      font-weight: 900;
      font-size: 22px
    }

    .kpi .unit {
      font-weight: 700;
      font-size: 14px;
      margin-left: 6px;
      color: #a8ffc9
    }

    .foot {
      margin-top: 8px;
      font-size: 12px;
      color: #a8b9d8;
      text-align: right
    }

    .mono {
      font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace
    }

    /* Neon meter */
    .meter {
      height: 8px;
      border-radius: 999px;
      background: rgba(255, 255, 255, .06);
      border: 1px solid var(--line);
      overflow: hidden
    }

    .meter>i {
      display: block;
      height: 100%;
      width: 0;
      background: linear-gradient(90deg, var(--blue-l), var(--green-l));
      filter: saturate(1.2);
      box-shadow: 0 2px 10px rgba(6, 182, 212, .35)
    }

    /* Tips */
    .tips {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 12px;
      margin-top: 12px
    }

    @media (max-width:1024px) {
      .tips {
        grid-template-columns: 1fr
      }
    }

    .tip {
      padding: 12px;
      border-radius: 12px;
      border: 1px dashed rgba(255, 255, 255, .14);
      background: linear-gradient(180deg, rgba(255, 255, 255, .03), rgba(255, 255, 255, .02));
      font-size: 13px;
      color: #cfe4ff
    }
  </style>
</head>

<body class="grid-anim">
  <div class="wrap">
    <header class="hero">
      <div class="title">
        <div class="mark"></div>
        <div>
          <h1>Solar Calculator <span class="logoText">• Brand #192b53</span></h1>
          <div class="sub">Volt UI — Futuristic grid • Neon accents • Live ring gauge</div>
        </div>
      </div>
      <div class="chip">Colors: <b>#ffa101</b>, <b>#234ca5→#00adef</b>, <b>#40b449→#7ac042</b></div>
    </header>

    <div class="grid">
      <!-- LEFT : Controls -->
      <aside class="card" aria-label="Inputs Panel">
        <div class="card-h">
          <div class="segs" role="tablist" aria-label="Consumer Type">
            <button class="seg active" data-cat="res" aria-selected="true">Residential</button>
            <button class="seg" data-cat="com" aria-selected="false">Commercial</button>
            <button class="seg" data-cat="ind" aria-selected="false">Industrial</button>
          </div>
        </div>
        <div class="card-b">
          <div class="row2">
            <div>
              <label for="bill">Monthly Bill (₹)<small class="hint">Typical home: ₹1,500–₹8,000</small></label>
              <input id="bill" class="inp" type="number" min="0" value="6000" />
            </div>
            <div>
              <label for="tariff">Avg Tariff (₹/kWh)<small class="hint">Eff. rate (₹6–₹15)</small></label>
              <input id="tariff" class="inp" type="number" min="1" step="0.5" value="15" />
              <input id="tariffR" class="range" type="range" min="6" max="18" step="0.5" value="15"
                aria-label="Tariff slider" />
            </div>
          </div>

          <div class="row2" style="margin-top:12px">
            <div>
              <label for="cost">Installed Cost (₹/kW)<small class="hint">Auto by category • editable</small></label>
              <input id="cost" class="inp" type="number" min="30000" step="500" value="55000" />
            </div>
            <div>
              <label for="area">Area per kW (sqft)<small class="hint">Auto by category • editable</small></label>
              <input id="area" class="inp" type="number" min="50" step="1" value="75" />
            </div>
          </div>

          <div class="row2" style="margin-top:12px">
            <div>
              <label for="offset">Offset Target (%)<small class="hint">Auto by category • editable</small></label>
              <input id="offset" class="inp" type="number" min="10" max="100" step="1" value="70" />
              <input id="offsetR" class="range" type="range" min="10" max="100" step="1" value="70"
                aria-label="Offset slider" />
            </div>
            <div>
              <label for="yield">Solar Yield<small class="hint">Site-specific PR</small></label>
              <select id="yield">
                <option value="1700">High (1700 kWh/kWp/yr)</option>
                <option value="1500" selected>Average (1500)</option>
                <option value="1300">Low (1300)</option>
              </select>
            </div>
          </div>

          <div class="row2" style="margin-top:12px">
            <div>
              <label for="subsidy">Subsidy / Capex Support (%)<small class="hint">Optional</small></label>
              <input id="subsidy" class="inp" type="number" min="0" max="80" step="1" value="0" />
            </div>
            <div>
              <label for="roof">Roof Type<small class="hint">Affects area factor</small></label>
              <select id="roof">
                <option value="1">RCC / Concrete (×1.0)</option>
                <option value="1.15">Metal Sheet (×1.15)</option>
                <option value="1.25">Tiled / Mixed (×1.25)</option>
              </select>
            </div>
          </div>

          <div style="margin-top:14px;display:flex;gap:12px;align-items:center">
            <button id="btnCalc" class="cta">Calculate</button>
            <div class="meter" style="flex:1"><i id="meterBar"></i></div>
          </div>
        </div>
      </aside>

      <!-- RIGHT : Dashboard -->
      <section class="card">
        <div class="card-b">
          <div class="dash">
            <div class="top">
              <div>
                <h3 style="margin:0 0 6px">Recommended Solar System Size</h3>
                <div class="ring" id="ring" style="--p:0%"><span class="mono" id="out-size">—</span></div>
                <div class="mini"><span id="out-area">Area required — sqft</span><br />Net‑metering assumed</div>
              </div>
              <div>
                <div class="stacks">
                  <div class="pile">
                    <div class="num mono" id="out-bill-now">—</div>
                    <div class="lbl">Current Bill</div>
                  </div>
                  <div class="pile">
                    <div class="num mono" id="out-bill-solar">—</div>
                    <div class="lbl">Bill With Solar</div>
                  </div>
                </div>
              </div>
              <div class="save">
                <h3>Start Saving <span class="pct mono" id="out-save-pct">—</span> from <b>Day <span
                      id="out-day">1</span></b></h3>
              </div>
            </div>

            <div class="rowKPI">
              <div class="kpi">
                <div class="ico">💰</div>
                <div>
                  <div class="v mono" id="out-cost">— <span class="unit">Lacs</span></div><small>System Cost (₹)</small>
                </div>
              </div>
              <div class="kpi">
                <div class="ico">🎁</div>
                <div>
                  <div class="v mono" id="out-cost-net">— <span class="unit">Lacs</span></div><small>Net Cost after
                    Support</small>
                </div>
              </div>
              <div class="kpi">
                <div class="ico">🌱</div>
                <div>
                  <div class="v mono" id="out-roi">—<span class="unit">% P.A.</span></div><small>Return On
                    Investment</small>
                </div>
              </div>
              <div class="kpi">
                <div class="ico">📅</div>
                <div>
                  <div class="v mono" id="out-payback">—</div><small>Payback (Years)</small>
                </div>
              </div>
            </div>

            <div class="tips">
              <div class="tip">Tip: Increase <b>offset</b> to reduce your monthly bill, but check roof area fits the new
                size.</div>
              <div class="tip">Tip: <b>Yield</b> depends on city, tilt, shading. Use 1300–1700 kWh/kWp/yr for India.
              </div>
              <div class="tip">Tip: O&M set to ~2% of capex; lifetime modeled for 25y with 1.5% annual degradation.
              </div>
            </div>

            <div class="foot"># Indicative results only. DISCOM policy & on‑site survey will determine actuals.</div>
          </div>
        </div>
      </section>
    </div>
  </div>

  <script>
    (function () {
      const $ = (id) => document.getElementById(id);

      // Category presets
      const PRESETS = {
        res: { costPerKW: 55000, areaPerKW: 75, offsetPct: 70 },
        com: { costPerKW: 50000, areaPerKW: 80, offsetPct: 65 },
        ind: { costPerKW: 48000, areaPerKW: 90, offsetPct: 60 }
      };
      let cat = 'res';
      let current = { ...PRESETS.res };

      // Tabs
      const segs = Array.from(document.querySelectorAll('.seg'));
      segs.forEach(s => s.addEventListener('click', () => {
        segs.forEach(b => { b.classList.remove('active'); b.setAttribute('aria-selected', 'false'); });
        s.classList.add('active'); s.setAttribute('aria-selected', 'true');
        cat = s.dataset.cat;
        const p = PRESETS[cat];
        $('cost').value = p.costPerKW;
        $('area').value = p.areaPerKW;
        $('offset').value = p.offsetPct;
        $('offsetR').value = p.offsetPct;
        current = { ...p };
        pulse();
        calculate();
      }));

      // Number ↔ range sync
      function bindSync(numId, rangeId, min = 0, max = 100, step = 1) {
        const n = $(numId), r = $(rangeId);
        if (!n || !r) return;
        const clamp = (v) => Math.max(min, Math.min(max, v));
        n.addEventListener('input', () => { r.value = clamp(+n.value || 0); calculate(); });
        r.addEventListener('input', () => { n.value = r.value; calculate(); });
      }
      bindSync('tariff', 'tariffR', 6, 18, 0.5);
      bindSync('offset', 'offsetR', 10, 100, 1);

      // Neon meter pulse
      function pulse() {
        const bar = document.getElementById('meterBar');
        bar.style.transition = 'none'; bar.style.width = '0%';
        requestAnimationFrame(() => {
          bar.style.transition = 'width .9s cubic-bezier(.2,.8,.2,1)';
          bar.style.width = '100%';
          setTimeout(() => { bar.style.transition = 'width .5s ease'; bar.style.width = '0%'; }, 1000);
        });
      }

      // Formatters
      const fmtINR = (n) => isFinite(n) ? n.toLocaleString('en-IN', { maximumFractionDigits: 0 }) : '—';
      const fmtLakh = (n) => isFinite(n) ? (n / 100000).toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) : '—';

      // Gauge
      function setRing(percent) {
        const g = document.getElementById('ring');
        g.style.setProperty('--p', Math.max(0, Math.min(100, percent)) + '%');
        g.animate([{ filter: 'brightness(1)' }, { filter: 'brightness(1.2)' }, { filter: 'brightness(1)' }], { duration: 600, easing: 'ease-out' });
      }

      function calculate() {
        const monthlyBill = +$('bill').value || 0;
        const t = Math.max(1, +$('tariff').value || 0);

        // overrides
        current.costPerKW = +$('cost').value || current.costPerKW;
        let areaPerKW = +$('area').value || current.areaPerKW;
        current.offsetPct = +$('offset').value || current.offsetPct;

        const siteYield = +$('yield').value || 1500; // kWh/kWp/yr
        const roofFactor = +$('roof').value || 1;    // area multiplier
        const subsidyPct = Math.max(0, Math.min(80, +$('subsidy').value || 0)) / 100;

        // consumption
        const monthlyKWh = monthlyBill / t;
        const annualKWh = monthlyKWh * 12;
        const offset = Math.min(100, Math.max(10, current.offsetPct)) / 100;
        const targetAnnualKWh = annualKWh * offset;

        // size
        let sizeKWp = targetAnnualKWh / siteYield;
        sizeKWp = Math.max(1, Math.round(sizeKWp * 2) / 2);
        const near = Math.round(sizeKWp); if (Math.abs(sizeKWp - near) < 0.11) sizeKWp = near;

        // derived
        const areaSqft = Math.round(sizeKWp * areaPerKW * roofFactor);
        const billWithSolar = Math.round(monthlyBill * (1 - offset));
        const grossCost = sizeKWp * current.costPerKW;
        const netCost = grossCost * (1 - subsidyPct);
        const annualSaving = (monthlyBill - billWithSolar) * 12;
        const roiPct = (annualSaving / netCost) * 100;
        const payYears = annualSaving > 0 ? (netCost / annualSaving) : Infinity;

        // Lifetime savings (25y, 1.5% degradation, 2% O&M on gross)
        const YEARS = 25, degr = 0.015, oandm = grossCost * 0.02; let life = 0;
        for (let i = 1; i <= YEARS; i++) { life += Math.max(0, annualSaving * Math.pow(1 - degr, i - 1) - oandm); }

        // paint
        $('out-size').textContent = `${sizeKWp} kW`;
        $('out-area').textContent = `Area required ${areaSqft} sqft`;
        $('out-bill-now').textContent = fmtINR(monthlyBill);
        $('out-bill-solar').textContent = fmtINR(billWithSolar);
        $('out-save-pct').textContent = `${Math.round(offset * 100)}%`;
        $('out-cost').innerHTML = `${fmtLakh(grossCost)} <span class="unit">Lacs</span>`;
        $('out-cost-net').innerHTML = `${fmtLakh(netCost)} <span class="unit">Lacs</span>`;
        $('out-roi').innerHTML = `${isFinite(roiPct) ? roiPct.toFixed(2) : '—'}<span class="unit">% P.A.</span>`;
        $('out-payback').textContent = isFinite(payYears) ? Math.max(1, Math.round(payYears)) : '—';

        // gauge
        setRing(offset * 100);
      }

      document.getElementById('btnCalc').addEventListener('click', () => { pulse(); calculate(); });
      ['yield', 'roof', 'subsidy', 'bill', 'tariff', 'cost', 'area', 'offset'].forEach(id => {
        const el = $(id); if (el) el.addEventListener('change', calculate);
      });

      // init
      (function init() {
        const p = PRESETS[cat];
        $('cost').value = p.costPerKW;
        $('area').value = p.areaPerKW;
        $('offset').value = p.offsetPct;
        $('offsetR').value = p.offsetPct;
        calculate();
      })();
    })();
  </script>

</body>

</html>