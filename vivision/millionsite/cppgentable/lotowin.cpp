


#include "regular.hpp"
#include "fl.hpp"
#include "math.hpp"
#include "algebra.hpp"
#include "comb.hpp"
//#include "threads.hpp"
#include "lotolib.hpp"
#include "arrayf.hpp"
#include "ohlcGlWindow.hpp"
#include <boost/unordered_map.hpp>
#include <iostream>
#include "timef.hpp"
#include <FL/Fl_Multi_Browser.H>
//void redrawWin(void* win);

const char* title="lotowinv1";
void seek( );

lotos* ltc=NULL;


Fl_Double_Window* win;

ohlcGlWindow*  mygl;
Fl_Button* btcima;
Fl_Button* btbaixo;
Fl_Button* btseg;
Fl_Button* btupdt;
Fl_Button* btc;
Fl_Button* btget;
Fl_Button* btfilter;
Fl_Box* txtcima;
Fl_Box* txtbaixo;
Fl_Box* txtseg;
Fl_Button** btg0;
Fl_Button** btg1;
Fl_Button** btg2;
Fl_Box** label;
Fl_Help_View* tabler;
Fl_Box* lbl;

vvvint betsr(4);
vvint res;


//int nncalc(vint sequence)


void upd()
{
    vvint &betsrl=betsr[ltc->jidx];
    //dbgv(betsrl[0].size(),betsrl[0].back())
//	if(betsrl.size()!=0)
    res=ltc->mustMatch(betsrl,0);
//	dbgv(res.size())
//	pausa
    stringstream strm;//http://amn.st/6180DI7vg
    strm<<(res.size())<<"<br>";
    strm<<"<font face=Arial color=black  size=2>";
    if(res.size()<6000)
        lop(i,0,res.size())
    {
        lop(ki,0,res[i].size())strm<<res[i][ki]<<" ";
        strm<<"<br>";
    }
    tabler->value(strm.str().c_str());
//		dbgv(strm.str())


}

void bremove()
{
    vvint &betsrl=betsr[ltc->jidx];
    if(betsrl.size()>0)betsrl.pop_back();
    upd();
}

int qtdmatch(vvbool &m,vint &b,int idx)
{
    int qt=0;
    lop(i,0,b.size())
    if(m[idx][ b[i] ])qt++;
    return qt;
}


vint searchr(vint qtdi,int qtb,	vint &body)
{
//int qtb=4;
    vint tosearch(qtdi.end()-qtb,qtdi.end());
    body.clear();
//	dbgvecall(tosearch)
    int num0=0;
    int num1=0;
    vint num(2);
    lop(i,0,qtdi.size())
    {
        bool flag=0;
        lop(c,0,qtb)
        {
            if(qtdi[i+c]==tosearch[c])
            {
                flag=1;
            }
            else flag=0;
            if(flag==0)break;
        }
//			dbgv(i,flag)
//			pausa
        if(flag==1)
        {
            if(qtdi[i+qtb]==0)num[0]++;
            if(qtdi[i+qtb]==1)num[1]++;
            body.push_back(num[1]-num[0]);
        }
    }

    return num;
//	dbgv(num0,num1)

}


vint searchrep(vint qtdi,vint matriz)
{
    //dbgvecall(qtdi)
    vint res(2);
    lop(i,matriz.size()-1,qtdi.size())
    {
        int &x1=qtdi[i-2];
        int &x2=qtdi[i-1];
        int &x3=qtdi[i];
        int c;
        if(x1==matriz[0] && x2 == matriz[1] && x3==0)
            res[0]++;
        if(x1==matriz[0]&&x2==matriz[1]&&x3==1)
            res[1]++;
//        dbgv(qtdi[i-1],qtdi[i])

    }
//    pausa
    return res;
}
vint searchrep3(vint qtdi,vint matriz)
{
    //dbgvecall(qtdi)
    vint res(2);
    lop(i,matriz.size()-1,qtdi.size())
    {
        int &x1=qtdi[i-3];
        int &x2=qtdi[i-2];
        int &x3=qtdi[i-1];
        int &x4=qtdi[i];
        if(x1==matriz[0] && x2 == matriz[1] && x3 == matriz[2] && x4==0)
            res[0]++;
        if(x1==matriz[0] && x2 == matriz[1] && x3 == matriz[2] && x4==1)
            res[1]++;
//        dbgv(qtdi[i-1],qtdi[i])

    }
//    pausa
    return res;
}

void seek( )
{
    win->copy_label("Wait...");
    Fl::check();

    vvbool &mvalues=ltc->histrb;
    int vsz=800;
    vvbool mvaluesl(mvalues.end()-vsz,mvalues.end());
    vbool cbin=vector<bool>(mvaluesl.size());

    vint bet;
    vint qtdi;
    int len=(int)(ltc->n/2.0);
    randsafe();
    vint betp=vint(ltc->n);
    iota(betp.begin(),betp.end(),1);
//perf.p();
    int c=0;
    int n0,n1,n2,n3,n4,n5;
    int na0,na1,na2,na3,na4,na5;
    int b0,b1,b2,b3,b4,b5;
    int nas=0;
    int sel=0;
    int minb2=100000;
    lop(co,0,1000000)
//    lop(co,0,1)
    {
//		bet=vint(0);
//		while(bet.size()<len)	vecpushuni(bet,rand()%ltc->n+1);
//bet=beta(len);
        bet=betp;
        lop(i,0,bet.size())
        {
            lop(j,mvaluesl.size()-0,mvaluesl.size())
            {
                if(mvaluesl[j][ bet[i] ] == 1)
                {
                    bet.erase (bet.begin() + i);
                    i--;
                }
            }
        }
        random_shuffle ( bet.begin(), bet.end() );
        bet=vint( bet.begin(), bet.begin()+len-0 );


        qtdi=vint(vsz);
        lop(i,0,vsz)qtdi[i]=qtdmatch(mvaluesl,bet,i);

        int &q1=qtdi[vsz-1];
        int &q2=qtdi[vsz-2];
        int &q3=qtdi[vsz-3];
        int &q4=qtdi[vsz-4];
        int &q5=qtdi[vsz-5];


//int m0?0;
//lop(mi,0,vsz){
//m'
//}



        n0=0;
        n1=0;
        n2=0;
        n3=0;
        n4=0;
        n5=0;
        lop(i,vsz-36,vsz-0)
        {
            if(qtdi[i]==2)n2++;
            if(qtdi[i]==3)n3++;
            if(qtdi[i]==4)n4++;
            if(qtdi[i]==1)n1++;
            if(qtdi[i]==0)n0++;
            if(qtdi[i]==5)n5++;
        }
        na0=0;
        na1=0;
        na2=0;
        na3=0;
        na4=0;
        na5=0;
        nas=0;
        lop(i,vsz-3,vsz-0)
        {
            if(qtdi[i]==2)na2++;
            if(qtdi[i]==3)na3++;
            if(qtdi[i]==4)na4++;
            if(qtdi[i]==1)na1++;
            if(qtdi[i]==0)na0++;
            if(qtdi[i]==5)na5++;
            nas+=qtdi[i];
        }

        b0=0;
        b1=0;
        b2=0;
        b3=0;
        b4=0;
        b5=0;
        lop(i, 0,vsz-0)
        {
            if(qtdi[i]==2)b2++;
            if(qtdi[i]==3)b3++;
            if(qtdi[i]==4)b4++;
            if(qtdi[i]==1)b1++;
            if(qtdi[i]==0)b0++;
            if(qtdi[i]==5)b5++;
            nas+=qtdi[i];
        }

        if(minb2>b2){minb2=b2;
cout<<endl<<minb2<<" "<<b2;
        if(minb2<=200){
            sel=2;
            break;
        }
        }
        continue;
        int qd=qtdi[vsz-1]+qtdi[vsz-2]+qtdi[vsz-3]+qtdi[vsz-4];

//break;
        if((ltc->jidx==0 || ltc->jidx==2))
        {

            if(

//                n3>160 &&
//                n2<120 &&
                b2<20
//                && b2>=20
            )
            {
                sel=2 ;
//				sel=rand()%2 + 2;
                dbgv(q1,b2)
                break;
            }
            if(

//                n3>160 &&
//                n2<120 &&
                n3==0 &&
                na3==0
//                 && b3>=20
            )
            {
                sel=3 ;
//				sel=rand()%2 + 2;
                dbgv(q1,b3)
                break;
            }

        }

//dbgv(na0,n0)
        if( (ltc->jidx==3))
        {
//            if(q1==0 && q2==0)continue;
//            if(q1==1 && q2==1)continue;
            vint matriz=vint(qtdi.end()-2,qtdi.end());
//dbgvecall(matriz);
            vint nums=searchrep(qtdi, matriz);


            vint matriz3=vint(qtdi.end()-3,qtdi.end());
            vint nums3=searchrep3(qtdi, matriz3);


            int x1=nums[1]-nums[0];
            int x2=nums3[1]-nums3[0];
            int x0=x1+x2;

            if(x2>10 && x1<3){
                sel=1;
            //dbgv(x1,x2,x0)
             //break;
            }
            if(n0<=11){
                sel=1;
                dbgv(n0,x1,x2,x0)
                break;
            }
///            dbgvecall(nums)
///            dbgvecall(nums3);
//            if(x1==0 && x2<=5 && x2>0 && n0==0){
//                sel=1;
//            dbgv(x1,x2,x0)
//            break;
//            }
//            if(x1==0 && x2>=-5 && x2<0 && n1==0){
//                sel=0;
//            dbgv(x1,x2,x0)
//            break;
//            }
//            vint nums=searchrep(qtdi, {0,1});
//            dbgv(nums[0],nums[1]);
//if( nums[1]>100 && nums[0]<95)break;
//            if(nums[0]>130 && nums[1]<80  )
////            if( nums[1]>110 && nums[0]<90)
//            {
//                dbgv(nums[0],nums[1]);
//                sel=0;
//
//            }
//            if(x1<-40 && x2<-40){sel=0;dbgv(x0); break;}
//            if(x0>45){sel=1;dbgv(x0); break;}
//            if(x0==0 && n0==1 && na0<5){sel=0;dbgv(x0,n0); break;}
//            if(x0==0 && n1==1 && na1<4){sel=1;dbgv(x0,n1); break;}
//            if(  n0==2 && na0<5)

//                {sel=1;dbgv(x0,n0); break;}
//            break;
//            if(  n1==2 && na1<5){sel=0;dbgv(x0,n1); break;}
//            if( nums[1]<90 && nums[0]>=120)
////            if( nums[1]>110 && nums[0]<90)
//            {
//                dbgv(nums[0],nums[1]);
//                sel=0;
//                break;
//            }
//				vint num5=searchr(qtdi,4);
//				float num5f=num5[1]-num5[0];
//
//				vint num7=searchr(qtdi,3);
//				float num7f=num7[1]-num7[0];
//
//				vint num11=searchr(qtdi,6);
//				float num11f=num11[1]-num11[0];
//
//
//
//
//				float tot=nm0+num7f+num11f+num5f;
//
//				dbgv(num[0],num[1],nm0,num7f,num11f,num5f,tot)
//            dbgv(num[0],num[1],nm)
//            dbgvecall(body)
//				pausa
//            if(nm <=-5
//              )
//            {
//                sel=1;
//                break;
//            }
//            if(nm >=5
//              )
//            {
//                sel=0;
//                break;
//            }

//				if(abs(num5f)<10)continue;
//				if(num7d<2 &&num7d>-2)continue;
//
//				if(nm0>0 && num7d<0)continue;
//				if(nm0<0 && num7d>0)continue;

//				float mdp=mathDiffPer(num[0],num[1],1);
//break;
        }


        if( ltc->jidx==1){
            if(
//								n1==41
//						n0<18 && n0>15 &&//				n3>=43  &&
//						n1>58 && //n1 > 48 &&

//				q1!=1 && q2!=1 && q3!=1 && q4!=1
//                na1<50 &&
                n1>=23 &&
                na1<=1
////						&&
//						n1>60
//				n3<49
          )
        {
            sel=1;
            break;
        }
        if(
           n1<=10
           )
            {
            sel=1;
            break;
        }
        if(
           n0<=1
           )
            {
            sel=1;
            break;
        }
        }
//				if( (ltc->jidx==1)
//						&&
//						n2<15 &&
//						na2<2
////						n0<18 && n0>15 &&//				n3>=43  &&
////						n1<51 && n1 > 49
////						n1>55
//////						&&
////						n1>60
////				n3<49
//				){sel=2;break;}









        c++;
//		if(c>1000000)break;
    }

    dbgv(nas)
//	perf.p("loop");
//	dbgv(n0,n1,n2,n3,n4,n5)
//	dbgv(na0,na1,na2,na3,na4,na5)
//dbgv(c)
    sort(bet.begin(),bet.end());

    stringstream strm;
    lop(i,0,20)
    {
        int ri=20-i;
        strm<<qtdi[vsz-ri]<<" ";
    }
    strm<<"\n";
    strm<<"n0:"<<n0<<" n1:"<<n1<<" n2:"<<n2<<" n3:"<<n3<<" n4:"<<n4<<" n5:"<<n5;
    strm<<"\n";
    strm<<"na0:"<<na0<<" na1:"<<na1<<" na2:"<<na2<<" na3:"<<na3<<" na4:"<<na4<<" na5:"<<na5;
    lbl->copy_label(strm.str().c_str());
     dbgvecall(qtdi)
    dbgvecall(bet)

    lop(i,0,vsz)
    {
        cbin[i]=qtdi[i]==1?1:0;
    }
    vint qti(vsz);
    lop(i,1,vsz)
    {
        qti[i]=qti[i-1]+qtdi[i];
    }



//sel=getnum(qtdi);

    vvint &betsrl=betsr[ltc->jidx];
    betsrl.push_back(bet);
    betsrl.back().push_back( 0 );


//lop(i,0,6)btg1[i]->clear();
    btg0[sel]->setonly();
    btg0[sel]->do_callback();

    mygl->ohlc.aglomerado=2;
    mygl->ohlc.offset=0;
    mygl->ohlc.toOhLcDirect(qtdi);
//	mygl->ohlc.toOhLcFromBin(cbin);
    mygl->distfix=22 ;

//dbgvecall(mvaluesl.back())
//dbgv(mvaluesl.size())


    mygl->updateChart(1);



    upd();

    win->copy_label(title);
}



void labelupd(int i,void*)
{
    int lb=ltc->lback+i;
    if(i!=0) //dbgv(ltc==0,ltc->jidx);
    {
        if(lb>0)
        {
            perf.p();
            ltc->update(0,lb-1);
            perf.p("update");
        }
    }
    if(i!=0)ltc->update(0,lb);
    dbgv("UPDATED")
//	dbgv(ltc->histrows.size());
    label[0]->copy_label(ltc->lastdate.c_str());
    label[1]->copy_label(ltc->nextdate.c_str());

    if(i!=0)
    {
        vvint &betsrl=betsr[ltc->jidx];
        betsrl.clear();
    }
    perf.p();
    upd();
    perf.p("upd");
//	if(i!=0)btseg->do_callback();

}


void profiler()
{
    int bj=ltc->jidx;

    btg1[bj]->setonly();
    btg1[bj]->do_callback();

//	ltc->update(0,1);
//int lookback=	0;
//labelupd(lookback,0);

//	ltc->histrows=vvint(ltc->histrows.begin(),ltc->histrows.end()-lookback);
//	ltc->histrb=vvbool(ltc->histrb.begin(),ltc->histrb.end()-lookback);


    lop(i,0,10)
    {
        seek();
//        break;
//        dbgv(i)
        if(res.size()<1)
        {
            bremove();
        }
        if(res.size()==1)break;
        dbgv(res.size())
    }



}


void filter()
{
    dbgv(res.size());
    res.pop_back();
    dbgv(res.size());
    upd();
    dbgv(res.size());

}
int countPermutations(int n)
{
    if(n == 0)
        return 1;
    if(n == 1)
        return 1;
    else
        return (n * countPermutations(n - 1)) +
                        ((n - 1) * countPermutations(n - 2));
}
int main()
{
//    int c=0;
//    int myints[] = {1,2,3,4,5,6,7,8,9,10,11,12,13};
//  do
//  {
//c++;
//  } while ( std::next_permutation(myints,myints+13) );
//std::cout << myints[0] << ' ' << myints[1] << ' ' << myints[2] <<" "<<c++<< '\n';
//
//cout<<endl<<countPermutations(13);
// pausa

    cout<<"teste";
    //return 0;
//	vlt[0]->cbrfill({35,36,41,41});
//	vlt[1]->cbrfill({55});
//	vlt[2]->cbrfill({33,38,38,40});
//	vlt[3]->cbrfill({13});

    comb cb(16,8);
    dbgv(cb.range)
//    pausa

    Fl::scheme("gtk+");
    win=new Fl_Double_Window(0,0,420,375,title);//

    //flicon(win);
    mygl=new ohlcGlWindow(0,60,250,200);

    btcima=new Fl_Button(250, 60, 30,80);
    btcima->label("@8UpArrow");
    btseg=new Fl_Button(250, 140, 30,40);
    btcima->callback([](Fl_Widget *, void* v)
    {
        bremove();
    });
    btseg->callback([](Fl_Widget *, void* v)
    {
        seek();
    });

    Fl_Button btu(210,280,70,20,"Update");
    btu.callback([](Fl_Widget*)
    {
        ltc->update(1,0);
        labelupd(0,0);
    });

    btc=new Fl_Button(210,260,70,20,"Check");
    btc->callback([](Fl_Widget*  )
    {
        if(ltc->nextv.size()==0)return;
        int ltf=0;
        bool found=0;
        lop(i,0,res.size())
        {
            ltf=0;
            lop(ki,0,ltc->k)
            if(ltc->nextv[ki]==res[i][ki])ltf++;
            if(ltf==ltc->k)found=1;
        }
        if(found)btc->color(FL_GREEN);
        else btc->color(FL_RED);
    });


    btget=new Fl_Button(240,240,40,20,"Get");
    btget->callback([](Fl_Widget*  )
    {
        dbgv(ltc->jidx)
        profiler();
    });

    btfilter=new Fl_Button(240,220,40,20,"Flt");
    btfilter->callback([](Fl_Widget*  )
    {
        dbgv(ltc->jidx)
        filter();
    });

    label=FlDoubleLabel(0,260,200,40,labelupd);

    lbl=new Fl_Box(0,300,300,80 );
    lbl->box(Fl_Boxtype::FL_THIN_DOWN_BOX);
    lbl->align(16|1|4);
    lbl->copy_label(" ");

    tabler = new Fl_Help_View(280,0,420-280, 375);
    tabler->textsize(17);
    tabler->color(0xbbddbb00);
    tabler->value("<font face=Arial >Be wise, confident and cautious.<p align=center></p></font>");



    btg1=flbtgroup(0,0,200,20, {"EM N","EM S","TT N","TT S"},4,
                   [](int a,void*)
    {
        ltc=vlt[a];
        labelupd(0,0);
//			seek();
    } );


//	btg2=flbtgroup(0,40,250,20,{"0","1"},2,
//		[](int a,void*){
//			vvint &betsrl=betsr[ltc->jidx];
//			if(betsrl.size()>0){
//				betsrl.back().pop_back();
//				betsrl.back().push_back(a);
//			}
//			upd();
//			btc->do_callback();
//			btc->damage(1);
//			Fl::check();
//		} );

    btg0=flbtgroup(0,20,250,20, {"0","1","2","3","4","5"},6,
                   [](int a,void*)
    {
        vvint &betsrl=betsr[ltc->jidx];
        if(betsrl.size()>0)
        {
            betsrl.back().pop_back();
            betsrl.back().push_back(a);
        }
        upd();
        btc->do_callback();
        btc->damage(1);
        Fl::check();
    } );


    flCenter(win);
    win->show();
    btg1[3]->setonly();
    btg1[3]->do_callback();



    Fl::lock();
    return Fl::run();
}




