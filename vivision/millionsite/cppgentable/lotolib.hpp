#ifndef lotolib_HPP_INCLUDED
#define lotolib_HPP_INCLUDED
//http://www.afasoft.net/softoto.html
//https://media.fdj.fr/generated/game/loto/nouveau_loto.zip

#include "comb.hpp"
#include <functional>

struct lotos;
extern vector<vector<lotos*>> vvlt;
extern vector<lotos*> vlt;

struct lotos{
	int jidx;
	vint gidx;
	string lastdate="";
	string nextdate;
	vint nextv;
	int lback=0;
	const vint nk;
	int n,k, csnrange;
	comb* cb=NULL;
	combtR* cbr=NULL;
	vint cbrvals;
	void cbrfill(vint cbrvals={});
	vvint cbrColsMtx;
	vvint cbrColsMtxGet();
	vector<vector<bool>> histrb;
	vector<vector<int>> hist;
	vector<vector<int>> histrows;
	vvfloat pernummatrizv;
	vvfloat pernummatriz();
	vfloat qtdsaidasper(int lookback); //qtdsaidas em matriz
	vint histcsn;
	vint histcsnRev;
	vint histcsnbal;
	vvint variacoesOne(int csnbal);
	int rangematrix;
	int kmatrix;
	vector<vvfloat> histinputs;
	int histsize=0;
	vector<int> soma;
	vector<vector<int>> rockmaxwHit;//n+1=currentCsn,n+2=currK
	lotos(int Jidx,vint Gidx,vint Nk,vint Cbrvals={});
	virtual void update(bool download=false,int lookback=0);
	void updminus1(vint &histlast,vbool &histblast);
	vector<bool> convertToBool();
	vector<int> indexesMatch();

	//tail is qtmatch
	vvint mustMatch(vvint keys,bool allpresent=true);
	float probacerto(int acertarem,int qtNumerosApostados=-1);
	vector<short> histscaled;
	vfloat histscaledf;
};

vvint aleatorios(int n,int k,int qtd);
vvint ausf(vvint &toa,int k,vint &ls,vfloat& lsper);
vvint ausen(vvint &rows,int n,int k);

vvint storyLoad(int jidx, vint &lastdates, bool download=0);
void promptz(function< void (vector<vector<int>> &cols,int idx, vector<int> &nk, vector<vector<int>> &res)> promptf);
#endif // ALGEBRA_HPP_INCLUDED
