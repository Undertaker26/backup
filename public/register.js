function validateForm(event) {
    var studentId = document.getElementById('student_id').value;
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('password_confirmation').value;
    var email = document.getElementById('email').value;
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

    // Clear previous error messages
    var errorMessages = document.querySelectorAll('.error-message');
    errorMessages.forEach(function(msg) {
      msg.textContent = '';
    });

    // Validate student ID length
    if (studentId.length !== 8) {
      document.getElementById('student_id_error').textContent = "Student ID must be exactly 8 digits.";
      event.preventDefault();
      return false;
    }

    // Validate username is not empty
    if (username.trim() === '') {
      document.getElementById('username_error').textContent = "Username is required.";
      event.preventDefault();
      return false;
    }

    // Validate email format
    if (!emailPattern.test(email)) {
      document.getElementById('email_error').textContent = "Please enter a valid email address.";
      event.preventDefault();
      return false;
    }

    // Validate password match
    if (password !== confirmPassword) {
      document.getElementById('password_error').textContent = "Passwords do not match.";
      event.preventDefault();
      return false;
    }
  }
  const provinces = ["Pangasinan"];
const cities = {
  "Pangasinan": ["Agno", "Aguilar", "Alaminos City", "Alcala", "Anda", "Asingan", "Balungao", "Bani", "Basista", "Bautista", "Bayambang", "Binalonan", "Binmaley", "Bolinao", "Bugallon", "Burgos", "Calasiao", "Dagupan City", "Dasol", "Infanta", "Labrador", "Laoac", "Lingayen", "Mabini", "Malasiqui", "Manaoag", "Mangaldan", "Mangatarem", "Mapandan", "Natividad", "Pozorrubio", "Rosales", "San Carlos City", "San Fabian", "San Jacinto", "San Manuel", "San Nicolas", "San Quintin", "Santa Barbara", "Santa Maria", "Santo Tomas", "Sison", "Sual", "Tayug", "Urdaneta City", "Urbiztondo", "Villasis"]
};
const barangays = {
  "Agno": ["Select", "Allabon", "Aloleng", "Bangan Oda", "Baruan", "Boboy", "Cayungnan", "Dangley", "Gayusan", "Macaboboni", "Magsaysay", "Namatucan",
      "Patar", "Poblacion East", "Poblacion West", "San Juan", "Tupa", "Viga"],

  "Aguilar": ["Select", "Bayaoas", "Baybay", "Bocacliw", "Bocboc East", "Bocboc West", "Buer", "Calsib", "Ninoy", "Poblacion", "Pogomboa", "Pogonsili", "San Jose", "Tampac", "Laoag", "Manlocboc", "Panacol"],

  "Alaminos City": ["Select", "Alos", "Amandiego", "Amangbangan", "Balangobong", "Balayang", "Bisocol", "Bolaney", "Baleyadaan", "Bued", "Cabatuan",
      "Cayucay", "Dulacac", "Inerangan", "Landoc", "Linmansangan", "Lucap", "Maawi", "Macatiw", "Magsaysay", "Mona", "Palamis", "Pandan", "Pangapisan",
      "Poblacion", "Pocal-Pocal", "Pogo", "Polo", "Quibuar", "Sabangan", "San Antonio", "San Jose", "San Roque", "San Vicente", "Santa Maria", "Tanytay",
      "Tangcarang", "Tawintawin", "Telbang", "Victoria"],


  "Alcala": ["Select", "Anulid", "Atainan", "Bersamin", "Canarvacanan", "Caranglaan", "Curareng", "Gualsic", "Kisikis", "Laoac", "Macayo", "Pindangan Centro", "Pindangan East", "Pindangan West", "Poblacion East", "Poblacion West", "San Juan", "San Nicolas", "San Pedro Apartado", "San Pedro Ili", "San Vicente", "Vacante"],

  "Anda": ["Select", "Awile", "Awag", "Batiarao", "Cabungan", "Carot", "Dolaoan", "Imbo", "Macaleeng", "Macando-candong", "Mal-ong", "Namagbagan", "Poblacion", "Roxas", "Sablig", "San Jose", "Siapar", "Tondol", "Tori-tori"],

  "Asingan": ["Select", "Ariston East", "Ariston West", "Bantog", "Baro", "Bobonan", "Cabalitian", "Calepaan", "Carosucan Norte", "Carosucan Sur", "Coldit", "Domanpot", "Dupac", "Macalong", "Palaris", "Poblacion East", "Poblacion West", "San Vicente Este", "San Vicente Weste", "Sanchez", "Sobol", "Toboy"],

  "Balungao": ["Select", "Angayan Norte", "Angayan Sur", "Capulaan", "Esmeralda", "Kita-kita", "Mabini", "Mauban", "Poblacion", "Pugaro", "Rajal", "San Andres", "San Aurelio 1st",
      "San Aurelio 2nd", "San Aurelio 3rd", "San Joaquin", "San Julian", "San Leon", "San Marcelino", "San Miguel", "San Raymundo"],

  "Bani": ["Select", "Ambabaay", "Aporao", "Arwas", "Ballag", "Banog Norte", "Banog Sur", "Calabeng", "Centro Toma", "Colayo", "Dacap Norte", "Dacap Sur", "Garrita", "Luac", "Macabit", "Masidem",
      "Poblacion", "Quinaoayanan", "Ranao", "Ranom Iloco", "San Jose", "San Miguel", "San Simon", "San Vicente", "Tiep", "Tipor", "Tugui Grande", "Tugui Norte"],

  "Basista": ["Select", "Anambongan", "Bayoyong", "Cabeldatan", "Dumpay", "Malimpec East", "Mapolopolo", "Nalneran", "Navatat", "Obong", "Osmena, Sr.", "Palma", "Patacbo", "Poblacion"],

  "Bautista": ["Select", "Artacho", "Baluyot", "Cabuaan", "Cacandongan", "Diaz", "Nandacan", "Nibaliw Norte", "Nibaliw Sur", "Palisoc", "Poblacion East",
      "Poblacion West", "Pogo", "Poponto", "Primicias", "Ketegan", "Sinabaan", "Vacante", "Villanueva"],

  "Bayambang": ["Select", "Alinggan", "Amanperez", "Amancosiling Norte", "Amancosiling Sur", "Ambayat I", "Ambayat II", "Apalen", "Asin", "Ataynan", "Bacnono", "Balaybuaya", "Banaban", "Bani", "Batangcaoa", "Beleng", "Bical Norte", "Bical Sur", "Bongato East", "Bongato West", "Buayaen", "Buenlag 1st",
      "Buenlag 2nd", "Cadre Site", "Carungay", "Caturay", "Darawey (Tangal)", "Duera", "Dusoc", "Hermoza", "Idong", "Inanlorenza", "Inirangan", "Iton",
      "Langiran", "Ligue", "M. H. del Pilar", "Macayocayo", "Magsaysay", "Maigpa", "Malimpec", "Malioer", "Managos", "Manambong Norte", "Manambong Parte", "Manambong Sur", "Mangayao", "Nalsian Norte", "Nalsian Sur", "Pangdel", "Pantol", "Paragos", "Poblacion Sur", "Pugo", "Reynado", "San Gabriel 1st", "San Gabriel 2nd", "SanVicente", "Sancagulis", "Sanlibo", "Sapang", "Tamaro", "Tambac", "Tampog", "Tanolong", "Tatarac", "Telbang", "Tococ East", "Tococ West", "Warding", "Wawa", "Zone I (Poblacion)", "Zone II (Poblacion)", "Zone III (Poblacion)", "Zone IV (Poblacion)", "Zone V (Poblacion)", "Zone VI (Poblacion)", "Zone VII (Poblacion)"],

  "Binalonan": ["Select", "Balangobong", "Bued", "Bugayong", "Camangaan", "Canarvacanan", "Capas", "Cili", "Dumayat", "Linmansangan", "Mangcasuy", "Moreno", "Pasileng Norte", "Pasileng Sur", "Poblacion", "San Felipe Central", "San Felipe Sur", "San Pablo", "Sta. Catalina", "Sta. Maria Norte", "Santiago", "Sto. Niño",
      "Sumabnit", "Tabuyoc", "Vacante"],

  "Binmaley": ["Select", "Amancoro", "Balagan", "Balogo", "Basing", "Baybay Lopez", "Baybay Polong", "Biec", "Buenlag", "Calit", "Caloocan Dupo", "Caloocan Norte", "Caloocan Sur", "Camaley", "Canaoalan", "Dulag", "Gayaman", "Linoc", "Lomboy", "Nagpalangan", "Malindong", "Manat", "Naguilayan", "Pallas", "Papagueyan", "Parayao", "Poblacion", "Pototan",
      "Sabangan", "Salapingao", "San Isidro Norte", "San Isidro Sur", "Santa Rosa", "Tombor"],

  "Bolinao": ["Select", "Arnedo", "Balingasay", "Binabalian", "Cabuyao", "Catuday", "Catungi", "Concordia (Poblacion)", "Culang", "Dewey",
      "Estanza", "Germinal (Poblacion)", "Goyoden", "Ilog-Malino", "Lambes", "Liwa-liwa", "Lucero", "Luciente 1.0 (J.Celeste)", "Luciente 2.0",
      "Luna", "Patar", "Pilar", "Salud", "Samang Norte", "Samang Sur", "Sampaloc", "San Roque", "Tara", "Tupa", "Victory", "Zaragoza"],

  "Bugallon": ["Select", "Angarian", "Asinan", "Bañaga", "Bacabac", "Bolaoen", "Buenlag", "Cabayaoasan", "Cayanga", "Gueset", "Hacienda", "Laguit Centro", "Laguit Padilla", "Magtaking", "Pangascasan", "Pantal", "Poblacion",
      "Polong", "Portic", "Salasa", "Salomague Norte", "Salomague Sur", "Samat", "San Francisco", "Umanday"],

  "Burgos": ["Select", "Anapao (Bur Anapac)", "Cacayasen", "Concordia", "Ilio-ilio (Iliw-iliw)", "Papallasen", "Poblacion", "Pogoruac", "Don Matias", "San Miguel", "San Pascual", "San Vicente",
      "Sapa Grande", "Sapa Pequeña", "Tambacan"],

  "Calasiao": ["Select", "Ambonao", "Ambuetel", "Banaoang", "Bued", "Buenlag", "Cabilocaan", "Dinalaoan", "Doyong", "Gabon", "Lasip", "Longos", "Lumbang", "Macabito",
      "Malabago", "Mancup", "Nagsaing", "Nalsian", "Poblacion East", "Poblacion West", "Quesban", "San Miguel", "San Vicente", "Songkoy", "Talibaew"],

  "Dagupan": ["Select", "Bacayao Norte", "Bacayao Sur", "Barangay I (T. Bugallon)", "Barangay II (Nueva)", "Barangay IV (Zamora)", "Bolosan", "Bonuan Binloc", "Bonuan Boquig", "Bonuan Gueset", "Calmay", "Carael", "Caranglaan", "Herrero St.", "Lasip Chico", "Lasip Grande", "Lomboy", "Lucao Dist.", "Malued", "Mamalingling", "Mangin", "Mayombo Dist.", "Pantal", "Poblacion Oeste", "Pogo Chico", "Pogo Grande", "Pugaro Suit", "Salapingao", "Salisay", "Tambac", "Tapuac", "Tebeng"],

  "Dasol": ["Select", "Alilao", "Amalbalan", "Bobonot", "Eguia", "Gais-Guipe", "Hermosa", "Macalang", "Magsaysay", "Malacapas", "Malimpin", "Osmeña", "Petal",
      "Poblacion", "San Vicente", "Tambac", "Tambobong", "Uli", "Viga"],

  "Infanta": ["Select", "Bamban", "Batang", "Bayambang", "Cato", "Doliman", "Patima", "Maya", "Nangalisan", "Nayom", "Pita", "Poblacion", "Potol", "Babuyan"],

  "Labrador": ["Select", "Bolo (*Kadampat, *Quiray)", "Bongalon", "Dulig", "Laois", "Magsaysay", "Poblacion", "San Gonzalo", "San Jose", "Tobuan", "Uyong"],

  "Laoac": ["Select", "Anis", "Balligi", "Banuar", "Botigue", "Caaringayan", "Domingo Alarcio (Cabilaoan East)", "Cabilaoan", "Cabulalaan", "Calaoagan", "Calmay",
      "Casampagaan", "Casanestebanan", "Casantiagoan", "Inmanduyan", "Poblacion (Laoac)", "Lebueg", "Maraboc", "Nanbagatan", "Panaga", "Talogtog", "Turko", "Yatyat"],

  "Lingayen": ["Select", "Aliwekwek", "Baay", "Balangobong", "Balococ", "Bantayan", "Basing", "Capandanan", "Domalandan Center",
      "Domalandan East", "Domalandan West", "Dorongan", "Dulag", "Estanza", "Lasip", "Libsong East", "Libsong West", "Malawa", "Malimpuec", "Maniboc", "Matalava", "Naguelguel",
      "Namolan", "Pangapisan North", "Pangapisan Sur", "Poblacion", "Quibaol", "Rosario", "Sabangan", "Talogtog", "Tonton", "Tumbar",
      "Wawa"],

  "Mabini": ["Select", "Bacnit", "Barlo", "Caabiangan", "Cabanaetan", "Cabinuangan", "Calzada", "Caranglaan", "De Guzman", "Luna - formerly known as Balayang", "Magalong", "Nibaliw", "Patar", "Poblacion", "San Pedro", "Tagudin", "Villacorta"],

  "Malasiqui": ["Select", "Abonagan", "Agdao", "Alacan", "Aliaga", "Amacalan", "Anolid", "Apaya", "Asin Este", "Asin Weste",
      "Bacundao Este", "Bacundao Weste", "Bakitiw", "Balite", "Banawang", "Barang", "Bawer", "Binalay", "Bobon", "Bolaoit", "Bongar", "Butao", "Cabatling", "Cabueldatan", "Calbueg",
      "Canan Norte", "Canan Sur", "Cawayan Bogtong", "Don Pedro", "Gatang", "Goliman", "Gomez", "Guilig", "Ican", "Ingalagala", "Lareg-lareg", "Lasip", "Lepa", "Loqueb Este", "Loqueb Norte", "Loqueb Sur", "Lunec", "Mabulitec", "Malimpec", "Manggan-Dampay", "Nancapian", "Nalsian Norte", "Nalsian Sur", "Nansangaan", "Olea", "Pacuan", "Palapar Norte", "Palapar Sur", "Palong", "Pamaranum", "Pasima", "Payar", "Poblacion", "Polong Norte", "Polong Sur", "Potiocan", "San Julian", "Tabo-Sili", "Tobor", "Talospatang", "Taloy", "Taloyan", "Tambac", "Tolonguat", "Tomling", "Umando", "Viado", "Waig", "Warey"],

  "Manaoag": ["Select", "Babasit", "Baguinay", "Baritao", "Bisal", "Bucao", "Cabanbanan", "Calaocan", "Inamotan", "Lelemaan",
      "Licsi", "Lipit Norte", "Lipit Sur", "Matulong", "Mermer", "Nalsian", "Oraan East", "Oraan West", "Pantal", "Pao", "Parian", "Poblacion", "Pugaro", "San Ramon", "Santa Ines", "Sapang", "Tebuel"],

  "Mangaldan": ["Select", "Alitaya", "Amansabina", "Anolid", "Banaoang", "Bantayan", "Bari", "Bateng", "Buenlag", "David", "Embarcadero", "Gueguesangen", "Guesang"
      , "Guiguilonen", "Guilig", "Inlambo", "Lanas", "Landas", "Maasin", "Macayug", "Malabago", "Navaluan", "Nibaliw", "Osiem", "Palua", "Poblacion", "Pogo", "Salaan", "Salay", "Talogtog", "Tebag"],

  "Mangatarem": ["Select", "Andangin", "Arellano Street (Poblacion)", "Bantay", "Bantocaling", "Baracbac", "Peania Pedania (Bedania)", "Bogtong Bolo", "Bogtong Bunao", "Bogtong Centro", "Bogtong Niog", "Bogtong Silag", "Buaya", "Buenlag", "Bueno", "Bunagan", "Bunlalacao", "Burgos Street (Poblacion)", "Cabaluyan 1st", "Cabaluyan 2nd", "Cabarabuan", "Cabaruan", "Cabayaoasan", "Cabayugan", "Cacaoiten", "Calomboyan Norte", "Calomboyan Sur", "Calvo (Poblacion)", "Casilagan", "Catarataraan", "Caturay Norte", "Caturay Sur", "Caviernesan", "Dorongan Ketaket", "Dorongan Linmansangan", "Dorongan Punta", "Dorongan Sawat", "Dorongan Valerio", "General Luna (Poblacion)", "Historia", "Lawak Langka", "Linmansangan", "Lopez (Poblacion)", "Mabini (Poblacion)", "Macarang", "Malabobo", "Malibong", "Malunec(original)", "Maravilla (Poblacion)", "Maravilla-Arellano Ext. (Pob)", "Muelang", "Naguilayan East", "Naguilayan West", "Nancasalan", "Cabison-Bulaney-Niog", "Olegario-Caoile (Poblacion)", "Olo Cacamposan", "Olo Cafabrosan", "Olo Cagarlitan", "Osmeña(Poblacion)", "Pacalat", "Pampano", "Parian", "Paul", "Pogon-Aniat (with Sitio Pinera)", "PogonLomboy (Poblacion)", "Ponglo-Baleg", "Ponglo-Muelag", "Quetegan (Pogon-Baleg)", "Quezon (Poblacion)", "Salavante", "Sapang", "Sonson Ongkit", "Suaco", "Tagac", "Takipan", "Talogtog", "Tococ Barikir", "Torre 1st", "Torre 2nd", "Torres Bugallon (Poblacion)", "Umangan", "Zamora (Poblacion)"],

  "Mapandan": ["Select", "Amanoaoac", "Apaya", "Aserda", "Baloling", "Coral", "Golden", "Jimenez", "Lambayan", "Luyan", "Nilombot", "Pias", "Poblacio", "Primicias", "Santa Maria", "Torres"],

  "Natividad": ["Select", "Barangobong", "Batchelor East", "Batchelor West", "Burgos (San Narciso)", "Cacandungan", "Calapugan", "Canarem", "Luna", "Poblacion East", "Poblacion West", "Rizal", "Salud", "San Eugenio", "San Macario Norte", "San Macario Sur", "San Maximo", "San Miguel", "Silag"],

  "Pozorrubio": ["Select", "Alipangpang", "Amagbagan", "Balacag", "Banding", "Bantugan", "Batakil", "Bobonan", "Buneg", "Cablong", "Casanfernandoan", "Castaño", "Dilan", "Don Benito", "Haway", "Imbalbalatong", "Inoman", "Laoac", "Maambal", "Malasin", "Malokiat", "Manaol", "Nama", "Nantangalan", "Palacpalac", "Palguyod", "Poblacion District I", "Poblacion District II", "Poblacion District III", "Poblacion District IV", "Rosario", "Sugcong", "Talogtog", "Tulnac", "Villegas"],

  "Rosales": ["Select", "Acop", "Bakit-Bakit", "Balincanaway", "Cabalaoangan Norte", "Cabalaoangan Sur", "Camangaan", "Capitan Tomas", "Carmay East", "Carmay West", "Carmen East", "Carmen West", "Casanicolasan", "Coliling", "Calanutan (Don Felix Coloma)", "Don Antonio Village", "Guiling", "Palakipak", "Pangaoan", "Rabago", "Rizal", "Salvacion", "San Antonio", "San Bartolome", "San Isidro", "San Luis", "San Pedro East", "San Pedro West", "San Vicente", "San Angel", "Station District", "Tumana East", "Tumana West", "Zone I (Poblacion)", "Zone IV (Poblacion)", "Zone II (Poblacion)", "Zone III (Poblacion)", "Zone V (Poblacion)"],

  "San Carlos City": ["Select", "Abanon,M.Soriano St. (Poblacion)", "Agdao", "Anando", "Antipangol", "Aponit", "Bacnar", "Balaya", "Balayong", "Baldog", "Balite Sur", "Balococ", "Bani", "Bocboc", "Bugallon-Posadas Street (Poblacion)", "Bogaoan", "Bolingit", "Bolosan", "Bonifacio (Poblacion)", "Buenglat", "Burgos-Padlan (Poblacion)", "Cacaritan", "Caingal", "Calobaoan", "Calomboyan", "Capataan", "Caoayan-Kiling", "Cobol", "Coliling", "Cruz", "Doyong", "Gamata", "Guelew", "Ilang", "Inerangan", "Isla", "Libas", "Lilimasan", "Longos", "Lucban (Poblacion)", "Mabalbalino", "Mabini (Poblacion)", "Magtaking", "Malacañang", "Maliwara", "Mamarlao", "Manzon", "Matagdem", "Mestizo Norte", "Naguilayan", "Nelintap", "Padilla-Gomez (Poblacion)", "Pagal", "Palaming", "Palaris (Poblacion)", "Palospos", "Pangalangan", "Pangoloan", "Pangpang", "Paitan-Panoypoy", "Parayao", "Payapa", "Payar", "Perez Boulevard (Poblacion)", "PNR Site (Poblacion)", "Polo", "Quezon Boulevard (Poblacion)", "Quintong", "Rizal Avenue (Poblacion)", "Roxas Boulevard (Poblacion)", "Salinap", "San Juan", "San Pedro (Poblacion)", "Sapinit", "Supo", "Talang", "Taloy (Poblacion)", "Tamayo", "Tandoc", "Tarece", "Tarectec", "Tayambani", "Tebag", "Turac", "Ano", "Tandang Sora (Poblacion)"],

  "San Fabian": ["Select", "Alacan", "Ambalangan-Dalin", "Angio", "Anonang", "Aramal", "Bigbiga", "Binday", "Bolaoen", "Bolasi", "Cabaruan", "Cayanga", "Colisao",
      "Gumot", "Inmalog Norte", "Inmalog Sur", "Lekep-Butao", "Lipit-Tomeeng", "Longos Central", "Longos Proper", "Longos-Amangonan-Parac-Parac Fabrica", "Mabilao", "NibaliwCentral", "Nibaliw East", "Nibaliw Magliba", "Nibaliw Narvarte (Nibaliw West Compound)", "Nibaliw Vidal (Nibaliw West Proper)", "Palapad", "Poblacion", "Rabon", "Sagud-Bahley", "Sobol", "Tempra-Guilig", "Tiblong", "Tocok"],

  "San Jacinto": ["Select", "Awai",
      "Bolo", "Capaoay (Poblacion East)", "Casibong", "Imelda (Decrito)", "Guibel", "Labney", "Magsaysay (Capay)", "Lobong", "Macayug", "Bagong Pag-asa", "San Guillermo (Poblacion West)", "San Jose", "San Juan", "San Roque", "San Vicente", "Santa Cruz", "Santa Maria", "Santo Tomas"],

  "San Manuel": ["Select", "San Antonio-Arzadon", "Cabacaraan", "Cabaritan", "Flores", "Guiset Norte (Poblacion)", "Guiset Sur (Poblacion)", "Lapalo", "Nagsaag", "Narra", "San Bonifacio", "San Juan", "San Roque", "San Vicente", "Sto. Domingo"],

  "San Nicolas": ["Select", "Bensican", "Cabitnongan", "Cabuloan", "Cacabugaoan", "Calanutian", "Calaocan", "Camangaan", "Camindoroan", "Casaratan", "Dalumpinas", "Fianza",
      "Lungao", "Malico", "Malilion", "Nagkaysa", "Nining", "Poblacion East", "Poblacion West", "Salingcob", "Salpad", "San Felipe East", "San Felipe West", "San Isidro (Santa Cruzan)", "San Jose", "San Rafael Centro", "San Rafael East", "San Rafael West", "San Roque", "Santa Maria East", "Santa Maria West", "Santo Tomas", "Siblot", "Sobol"],

  "San Quintin": ["Select", "Alac", "Baligayan", "Bantog", "Bolintaguen", "Cabangaran", "Cabalaoangan", "Calomboyan", "Carayacan", "Casantamaria-an", "Gonzalo", "Labuan", "Lagasit", "Lumayao", "Mabini", "Mantacdang", "Nangapugan", "San Pedro", "Ungib", "Poblacion Zone I", "Poblacion Zone II", "Poblacion Zone III"],

  "Santa Barbara": ["Select", "Alibago", "Balingueo", "Banaoang", "Banzal", "Botao", "Cablong", "Carusucan", "Dalongue", "Erfe", "Gueguesangen", "Leet", "Malanay",
      "Maningding", "Maronong", "Maticmatic", "Minien East", "Minien West", "Nilombot", "Patayac", "Payas", "Tebag East", "Tebag West", "Poblacion Norte", "Poblacion Sur", "Primicias", "Sapang", "Sonquil", "Tuliao", "Ventenilla"],

  "Santa Maria": ["Select", "Bal-loy", "Bantog",
      "Caboluan", "Cal-litang", "Capandanan", "Cauplasan", "Dalayap", "Libsong", "Namagbagan", "Paitan", "Pataquid", "Pilar", "Poblacion East", "Poblacion West", "Pugot", "Samon", "San Alejandro", "San Mariano", "San Pablo", "San Patricio", "San Vicente", "Santa Cruz", "Sta. Rosa"],

  "Santo Tomas": ["Select", "La Luna", "Poblacion East", "Poblacion West", "Salvacion", "San Agustin", "San Antonio", "San Jose", "San Marcos", "Santo Domingo", "Santo Niño"],

  "Sison": ["Select", "Agat", "Alibeng", "Amagbagan", "Artacho", "Asan Norte", "Asan Sur", "Bantay Insik", "Bila", "Binmeckeg", "Bulaoen East", "BulaoenWest", "Cabaritan", "Calunetan", "Camangaan", "Cauringan", "Dungon", "Esperanza", "Inmalog", "Killo", "Labayug", "Paldit", "Pindangan", "Pinmilapil", "Poblacion Central", "Poblacion Norte", "Poblacion Sur", "Sagunto", "Tara-tara"],

  "Sual": ["Select", "Baquioen", "Baybay Norte", "Baybay Sur", "Bolaoen", "Cabalitian", "Calumbuyan", "Camagsingalan", "Caoayan", "Capantolan", "Macaycayawan", "Paitan East", "Paitan West", "Pangascasan", "Poblacion", "Santo Domingo", "Seselangen", "Sioasio East", "Sioasio West", "Victoria"],

  "Tayug": ["Select", "Agno", "Amistad", "Barangobong", "Carriedo", "C. Lichauco", "Evangelista", "Guzon", "Lawak", "Legaspi", "Libertad", "Magallanes", "Panganiban", "Brgy. Poblacion A", "Brgy. Poblacion B", "Brgy. Poblacion C", "Brgy. Poblacion D", "Saleng", "Santo Domingo", "Toketec", "Trenchera", "Zamora"],

  "Urdaneta City": ["Select", "Anonas", "Bactad East", "Bayaoas", "Bolaoen", "Cabaruan", "Cabuloan", "Camanang", "Camantiles", "Casantaan", "Catablan", "Cayambanan", "Consolacion", "Dilan-Paurido", "Labit Proper", "Labit West", "Mabanogbog", "Macalong", "Nancalobasaan", "Nancamaliran East", "Nancamaliran West", "Nancayasan", "Oltama", "Palina East", "Palina West", "Pedro T. Orata (Bactad Proper)", "Pinmaludpod", "Poblacion", "San Jose", "San Vicente", "Santa Lucia", "Santo Domingo", "Sugcong",
      "Tiposu", "Tulong"],

  "Urbiztondo": ["Select", "Angatel", "Balangay", "Batancaoa", "Baug", "Bayaoas", "Bituag", "Camambugan", "Dalanguiring", "Duplac", "Galarin", "Gueteb", "Malaca", "Malayo", "Malibong", "Pasibi East", "Pasibi West", "Pisuac", "Poblacion", "Real", "Salavante", "Sawat"],

  "Villasis": ["Select", "Amamperez", "Bacag", "Barangobong", "Barraca", "Capulaan", "Caramutan", "La Paz", "Labit", "Lipay", "Lomboy", "Piaz (Plaza)", "Zone V (Poblacion)", "Zone I (Poblacion)", "Zone II (Poblacion)", "Zone III (Poblacion)", "Zone IV (Poblacion)", "Puelay", "San Blas", "San Nicolas", "Tombod", "Unzad]"]
}

function populateProvinces() {
  const provinceSelect = document.getElementById("province");
  provinces.forEach(province => {
    const option = document.createElement("option");
    option.value = province;
    option.textContent = province;
    provinceSelect.appendChild(option);
  });
}

function populateCities() {
  const provinceSelect = document.getElementById("province");
  const citySelect = document.getElementById("city");
  const barangaySelect = document.getElementById("barangay");

  citySelect.innerHTML = '<option value="">Select City</option>';
  barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

  const selectedProvince = provinceSelect.value;
  if (selectedProvince && cities[selectedProvince]) {
    cities[selectedProvince].forEach(city => {
      const option = document.createElement("option");
      option.value = city;
      option.textContent = city;
      citySelect.appendChild(option);
    });
  }
}

function populateBarangays() {
  const citySelect = document.getElementById("city");
  const barangaySelect = document.getElementById("barangay");

  barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

  const selectedCity = citySelect.value;
  if (selectedCity && barangays[selectedCity]) {
    barangays[selectedCity].forEach(barangay => {
      const option = document.createElement("option");
      option.value = barangay;
      option.textContent = barangay;
      barangaySelect.appendChild(option);
    });
  }
}

window.onload = function() {
  populateProvinces();
}