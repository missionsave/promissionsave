

#include "regular.hpp"
#include "arrayf.hpp"
#include "math.hpp"
//#include "comb.hpp"
#include "filesystem.hpp"
#include "lotolib.hpp"
#include "serialize.hpp"
#include <sstream>
//#include "ssh.hpp"
#include <numeric>

#define _SECURE_SCL 0

vector<vector<lotos*>> vvlt={
{	new lotos(0,{0,0}, {50,5} ), new lotos(1,{0,1}, {12,2} ) },
{	new lotos(2,{1,0}, {49,5} ), new lotos(3,{1,1}, {13,1} ) }
};
vector<lotos*> vlt={vvlt[0][0],vvlt[0][1],vvlt[1][0],vvlt[1][1]};


#include <curl/curl.h>
size_t WriteCallback(char* contents, size_t size, size_t nmemb, void* userp){
	((std::string*)userp)->append((char*)contents, size * nmemb);
	return size * nmemb;
}
string httpget(string url){
	curl_global_init(CURL_GLOBAL_ALL);
	CURL* easyhandle = curl_easy_init();
	std::string readBuffer;
	curl_easy_setopt(easyhandle, CURLOPT_URL, url.c_str());
//	curl_easy_setopt(easyhandle, CURLOPT_VERBOSE, 1L);
	//curl_easy_setopt(easyhandle, CURLOPT_PROXY, "http://my.proxy.net");   // replace with your actual proxy
	//curl_easy_setopt(easyhandle, CURLOPT_PROXYPORT, 8080L);
	curl_easy_setopt(easyhandle, CURLOPT_WRITEFUNCTION, WriteCallback);
	curl_easy_setopt(easyhandle, CURLOPT_WRITEDATA, &readBuffer);
	curl_easy_setopt(easyhandle, CURLOPT_HEADER, false);
	curl_easy_perform(easyhandle);
	return readBuffer;
}


vvint aleatorios(int n,int k,int qtd){
vvint ar(qtd,vint(k));
lop(i,0,ar.size()){
vint m(n);
std::vector<int> l(n);
std::iota(l.begin(), l.end(), 1);
lop(ki,0,k){
	int r=rand()%n;
	if(l[r]==0){ ki--;continue;}
	ar[i][ki]=l[r];
	l[r]=0;;
}
sort(ar[i].begin(),ar[i].end());
//dbgvecall(ar[i])
}
return ar;
}


vvint ausf(vvint &toa,int k,vint &ls,vfloat& lsper){
ls=vint  (100);
lsper=vfloat  (100);
vvint aus=vvint(toa.size(),vint(k));
int io=0;
lop(i,0,aus.size()){
	for(int o=i-1;o>0;o--){
			bool flag=0;
		lop(p,0,k){
			lop(pi,0,k)
			if(aus[i][p]==0 && toa[i][p]==toa[o][pi]){
					io=i-o;
			if(io>99)io=99;
				aus[i][p]=io;
				ls[io]++;
				flag=1;
				lop(u,0,k){
				if(aus[i][u]==0)flag=0;

				}
		}
		}
		if(flag)break;
	}
//dbgvecall(aus[i])
}
float sum=mathSum(ls,0,100);
lop(i,0,100){
	lsper[i]=ls[i]/sum;
}
return aus;

}


vvint ausen(vvint &rows,int n,int k){
	vint aus(n+1);
	lop(ni,1,n+1){
		for(int i=rows.size()-1;i>0;i--){
			lop(ki,0,k){
//			dbgv(rows[i][ki],ni)
				if(aus[ni]==0 && rows[i][ki]==ni)
					aus[ni]=rows.size()-i;
			}
		}
	}
	vvint ausn=vvint(100);
	lop(i,1,n+1){
		ausn[aus[i]].push_back(i);
	}
//	dbgvecall(aus);
//	lop(i,1,n+1){
//	cout<<endl<<i<<" ";
//	lop(ki,0,ausn[i].size())cout<<ausn[i][ki]<<" ";
//	}
return ausn;
}

float lotos::probacerto(int acertarem,int qtNumerosApostados){
if(qtNumerosApostados==-1)qtNumerosApostados=k;
return (float)(comb(k,acertarem).range*comb(n-k,qtNumerosApostados-acertarem).range) / comb(n,qtNumerosApostados).range;
}

vvint lotos::mustMatch(vvint keys,bool allpresent){
	bool restrictunion[n+1];
	fill(restrictunion,restrictunion+(n+1),0);
	lop(v,0,keys.size())lop(i,0,keys[v].size()-1)
		restrictunion[ keys[v][i] ]=1;

	bool kes[keys.size()][n+1];
	lop(v,0,keys.size()){
		fill(kes[v],kes[v]+(n+1),0);
		lop(i,0,keys[v].size()-1)
			kes[v][ keys[v][i] ]=1;
	}
//pausa
	comb cb(n,k);
	if(keys.size()==0)return vvint(cb.range);///better than return 0
	int cbp[k];
	int ru=0;
	bool add;
	vvint res;
	for(int csn=cb.range;csn--;){
		cb.toComb (csn,cbp);
//		cb.toCombFaster(csn,cbp);
//		dbgv(k,csn,cbp[0])
		if(allpresent){
			ru=0;	for(int i=k;i--;)ru+=restrictunion[ cbp[i] ];
			if(ru<k)continue;
		}
		add=true;
		lop(v,0,keys.size()){
			ru=0;	for(int i=k;i--;)ru+=kes[v][ cbp[i] ];
			if(ru!=keys[v].back()){add=false; break;}
		}
		if(add){
			res.push_back(vector<int>(cbp,cbp+k));
		}
	}
	return res;
}

#include <iostream>
vvvvint historyload;
bool updated=0;
vvint storyLoad(int jidx, vint &lastdates, bool download){

    //pausa
//	 	serializeSaveLoad("lotto.hst",historyload,0,1,1);
//	 	return;
//	if(updated)return;
//	dbgv(99)
//	updated=1;
	AppSetWorkingDir();
	vvint vals;
	//load local
// 	serializeSaveLoad("lotto.hst",historyload,0,1,1);
//	if(!download && historyload[0][0].size()>0)return;

	vstring jogourl= {"/EuroMilhoes.log","/Totoloto5.log"};
	vstring jogofile= {"./HistEuroMilhoes.log","HistTotoloto5.log"};
	string get;
	vstring lines;
	int startin=0;
//	startin=historyload[fi][0].size();
//download=1;
dbgv(download)
 if(download){
//	httpget(get,"afasoft.net",jogourl[0]);
	get=httpget("afasoft.net"+jogourl[0]);
	ofstream myfile;
  myfile.open (jogofile[0]);
  myfile << get;
  myfile.close();
//	httpget(get,"afasoft.net",jogourl[1]);
	get=httpget("afasoft.net"+jogourl[1]);
  myfile.open (jogofile[1]);
  myfile << get;
  myfile.close();
}

if(jidx== 0 || jidx==1){
	ifstream inFile;
	inFile.open(jogofile[0]);//open the input file
	stringstream strStream;
	strStream << inFile.rdbuf();//read the file
	string str = strStream.str();
	lines=split(str,"\n");
}
if(jidx== 2 || jidx==3){
	ifstream inFile;
	inFile.open(jogofile[1]);//open the input file
	stringstream strStream;
	strStream << inFile.rdbuf();//read the file
	string str = strStream.str();
	lines=split(str,"\n");
}

	if(jidx==0){
	for(int l=4;l<lines.size();l++){
		vstring lv=split(lines[l]," ");
		if(lv.size()<9)continue;

		int lastdate= stoi(string(lv[0].begin(),lv[0].begin()+(l>500?6:2)));

		vals.push_back({stoi(lv[1]),stoi(lv[2]),stoi(lv[3]),stoi(lv[4]),stoi(lv[5])});
//		dbgv(lv[0])pausa
		lastdates.push_back({lastdate}); ;
	}

	return vals;
}

	if(jidx==1){
	for(int l=4;l<lines.size();l++){
		vstring lv=split(lines[l]," ");
		if(lv.size()<9)continue;
		int lastdate= stoi(string(lv[0].begin(),lv[0].begin()+(l>500?6:2)));
		vals.push_back({stoi(lv[7]),stoi(lv[8]) });
		lastdates.push_back({lastdate});
	}
	return vals;
	}
 if(jidx==2){
	for(int l=4;l<lines.size();l++){
		vstring lv=split(lines[l]," ");
		if(lv.size()<9)continue;
		int lastdate= stoi(string(lv[0].begin(),lv[0].begin()+6));
		vals.push_back({stoi(lv[2]),stoi(lv[3]),stoi(lv[4]),stoi(lv[5]),stoi(lv[6])});
		lastdates.push_back({lastdate});
	}
	return vals;
	}
 if(jidx==3){
	for(int l=4;l<lines.size();l++){
		vstring lv=split(lines[l]," ");
		if(lv.size()<9)continue;
		int lastdate= stoi(string(lv[0].begin(),lv[0].begin()+6));
		vals.push_back({stoi(lv[8]) });
		lastdates.push_back({lastdate});
	}
	return vals;
	}
//	 	serializeSaveLoad("lotto.hst",historyload,1,1,1);
}


vvint lotos::variacoesOne(int csnbal){
			dbgv (mathBinaryRep(csnbal) );
	lop(i,0,kmatrix){
		csnbal^=bit[i];
		dbgv (mathBinaryRep(csnbal) ,csnbal);
int csn=csnbal;
if(csn%2!=0)	csn=rangematrix-csn ;
dbgv(csn);
		csnbal^=bit[i];

	}
return {{}};
}

void lotos::updminus1(vint &histlast,vbool &histblast){
	histlast=histrows.back();
	histblast=histrb.back();

	histrows.pop_back();
	histrb.pop_back();
}

void lotos::update(bool download,int lookback){
	if(lookback<0)return;
//	hist=storyLoadFile(nk,jidx,download,lastdate,false);
//	histrows=storyLoadFile(nk,jidx,download,lastdate,true);
//	if(gidx[0]==0 &&gidx[1]==0)
	vint lastdates;
		histrows=storyLoad(jidx,lastdates,download);
dbgv(histrows.size(), lookback);

//dbgv( historyload [0][1].size());
//dbgv( historyload[0][0].size());
//dbgv( historyload[1][0].size());
//dbgv( historyload[1][1].size());
//dbgv(gidx[0],gidx[1])
//dbgv(historyload[gidx[0]][gidx[1]].size());
//dbgv(histrows.size())
//dbgv(historyload .size());
//if(histrows.size()==0)
//	histrows=historyload [gidx[0]][gidx[1]];
//dbgv(histrows.size());
//dbgvecall(lastdates)
	lback=lookback;
//		dbgv(lback)
//	dbgv(lastdates[histrows.size()-lback])
	if(lback>0){
		nextdate=to_string(lastdates[histrows.size()-lback])+": "+	join(histrows[histrows.size()-lback]);
		nextv=	histrows[histrows.size()-lback];
	}else{
		nextdate="";
		nextv=vint(0);
	}

//pausa

	histrows=vvint(histrows.begin(),histrows.end()-lookback);
	lastdate=to_string(lastdates[histrows.size()-1])+": "+	join(histrows.back());
	if(histrows.size()==0)return;
	hist=vrotate(histrows );
	histsize=(histrows.size());
//pausa
//	return;

	soma=vint (histsize);
	lop(i,0,histsize)lop(ki,0,k)soma[i]+=hist[ki][i] ;
	histrb=vvbool(histsize,vbool(n+1));
	lop(i,0,histsize)lop(ki,0,k)histrb[i][  histrows[i][ki]  ]=1;

	histcsn=vint (histsize);
	histcsnRev=vint (histsize);
	if(cb)delete cb;
	cb=new comb(nk[0],nk[1]);
	csnrange=cb->range;
	lop(i,0,histsize)
		histcsn[i]=cb->toCsn(histrows[i]);

//arrInvertFromBehind(rgc->hist[c],invert,invert.size(),rgc->cb.n);
// rgc->csnInverted[c]=rgc->cb.toCsn( vraw( invert));


	histscaled=vshort (histsize);
		lop(i,0,histcsn.size())histscaled[i]=
			mathNumscale
				(histcsn[i],32767.0,0,cb->range,0);


	//histinputs 5x8bit scaled with output bit,from histcsnbal
	// kmatrix,idx,5f+1fout
	kmatrix=floorf(log2(cb->range)+0.999999);
	rangematrix=pow(2,kmatrix);
//	dbgv(rangematrix,kmatrix);

	histcsnbal=histcsn;
	lop(i,0,histsize)
		if(histcsn[i]%2!=0)histcsnbal[i]=rangematrix-histcsn[i] ;

	cbrfill();

	pernummatriz();

}
void lotos::cbrfill(vint Cbrvals){
	if(Cbrvals.size()!=0)cbrvals=Cbrvals;
	if(cbrvals.size()!=0){
		cbr=new combtR();
		cbr->init(nk,cbrvals);
		cbr->convertToR(hist);
		cbrColsMtx=vvint(cbr->rangesR.size());
		lop(i,0,cbrColsMtx.size()){
			cbrColsMtx[i]=vint(cbr->rangesR[i]);
			std::iota(cbrColsMtx[i].begin(), cbrColsMtx[i].end(), 0);
		}
	}

}
lotos::lotos(int Jidx,vint Gidx,vint Nk,vint Cbrvals): gidx(Gidx), nk(Nk), cbrvals(Cbrvals){
	n=nk[0]; k=nk[1]; jidx=Jidx;
//	toUpd.push_back(this);
	dbgv(jidx)
//	if(jidx!=3)
        update();
}


vvint lotos::cbrColsMtxGet(){
	return cbr->convertFromMtx(cbrColsMtx,4096);
}

vvfloat lotos::pernummatriz(){
	vvfloat res(k,vfloat(n+1));
	comb cb(n,k);
	int cbk[k];
	lop(i,0,cb.range){
		cb.toComb(i,cbk);
		lop(ci,0,k){
			res[ci][cbk[ci] ]++;
		}
	}
	vfloat sum(k);
	lop(i,0,k)
		lop(ci,0,n+1)
			sum[i]+=res[i][ci];
//	lop(i,0,k)
//		dbgvecall(res[i]);
//	dbgvecall(sum);
	lop(i,0,k)
		lop(ci,0,n+1)
			res[i][ci]=res[i][ci]/sum[i];
//	lop(i,0,k)
//		dbgvecall(res[i]);
//
//		vfloat sumi(k);
//		lop(i,0,k)
//		lop(ci,0,n+1)
//			sumi[i]+=res[i][ci];
//	dbgvecall(sumi);
	pernummatrizv=res;
	return res;
}
#include <iostream>
#include "stringf.hpp"

vector<vector<int>> fillColRandx(vector<int> sheme,int qt){
    vector<vector<int>> story(sheme[1]);
    vector <int> enumer(sheme[0]);
    for(int n=0;n<enumer.size();n++)enumer[n]=n+1;
    for(int i=0;i<qt;i++){
        vector <int> en=enumer;
        vector <int> vr(story.size());
        for(int n=0;n<story.size();n++){
            int r=randx()%enumer.size();//randI(0,enumer.size());
            vr[n]=en[r];
            en[r]=0;
            if(vr[n]==0)n--;
        }
        sort(vr.begin(),vr.end());
        for(int n=0;n<story.size();n++){
//            dbgp(" %d",vr[n]);
            story[n].push_back(vr[n]);
        }
//        dbgp("\n");
    }
    return story;
};



void promptz(function< void (vector<vector<int>> &cols,int idx, vector<int> &nk, vector<vector<int>> &res)> promptf){
    vector<vector<vector<int>>> jogo={{{50,5},{11,2}},{{49,5},{13,1}}};
    string inp="" ;
//    setconsolecolor(10);
    cout << "\n0 1 (r:retrieve s:simul):";
//    setconsolecolor(7);
    getline(cin,inp);
    fflush(stdout);
    vector<string> input=split(inp," ");
    inp=input[0];
    int jogoidx=0;
    try{jogoidx=std::stoi(inp);}catch (...) {promptz(promptf);}
    if(jogoidx<0 || jogoidx>1)promptz(promptf);
    bool retrieve=contains(inp,"r");
    int idxb=0;
    if(input.size()>1)try{idxb=stoi(input[1]);}catch(...){promptz(promptf);};
    if(contains(inp,"s") && idxb==0)idxb=1;
//    randxsafe();randtsafe();
//    for(int subj=jogo[jogoidx].size()-1;subj>=0;subj--){
    for(int subj=0;subj<jogo[jogoidx].size();subj++){
        int k=jogo[jogoidx][subj][1];
        vector<vector<int>> storyall;
        if(contains(inp,"s"))
            storyall=fillColRandx(jogo[jogoidx][subj],10000);
        else{
										dbgv(jogoidx)dbgv(jogoidx,subj)
int jidx=0;
if(jogoidx==0 && subj==1)jidx=1;
if(jogoidx==1 && subj==0)jidx=2;
if(jogoidx==1 && subj==1)jidx=3;
//pausa
vint lastdates;
vvint storyall_= storyLoad(jidx, lastdates, retrieve);
storyall=vrotate(storyall_);
//            storyall=(storyLoadFile(jogo,jogoidx,subj,retrieve));
        }
        int idx=storyall[0].size()-idxb;
        if(idx<1)promptz(promptf);
        if(promptf && contains(inp,"t")){
//            setconsolecolor(10);cout<<(subj==0?"Numbers:":"Stars:")<<endl;setconsolecolor(7);
            int wins[k+1];fill(wins,wins+(k+1),0);
            lop(idxt,0,storyall[0].size()){
                vector<vector<int>> res;
                promptf(storyall,idxt,jogo[jogoidx][subj],res);
                lop(ri,0,res.size()){
                    int iguais=0;
                    lop(ig,0,k)
                        lop(ir,0,res[ri].size())
                            if(res[ri] [ir]==storyall[ig][idxt])iguais++;
                    wins[iguais]++;
                }
//                cout<<iguais<<endl;
            }
            dbgpa(wins,0,k+1);
            cout<<endl;continue;
        }
//        setconsolecolor(10);
        idxb==0?dbgp("\nidx: %d",idx):dbgpvrow(storyall,idx,idx);
//        setconsolecolor(3);
        lop(prev,1,4)dbgpvrow(storyall,idx-prev,idx-prev);
//        setconsolecolor(7);

        vector<vector<int>> res;
        if(promptf){
            promptf(storyall,idx,jogo[jogoidx][subj],res);
            int wins[k+1];fill(wins,wins+(k+1),0);
            lop(ri,0,res.size()){
                int iguais=0;
                lop(ig,0,k)
                    lop(ir,0,res[ri].size())
                        if(res[ri] [ir]==storyall[ig][idx])iguais++;
                wins[iguais]++;
                dbgpa(res[ri],0,res[ri].size());
            }
            dbgpa(wins,0,k+1);
        }
    }
    promptz(promptf);
};

#define _SECURE_SCL 1
