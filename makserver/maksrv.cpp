#include <fstream>
#if 1 //common
#include <stdio.h>
#include <iostream>
#include <iomanip>
#include <configuru.hpp>
using namespace configuru;
#include <string>
#include <thread>
#include <mutex>
// #include <regex>
using namespace std;
typedef vector<float> vfloat;
typedef vector<vector<float>> vvfloat;
typedef vector<bool> vbool;
typedef vector<string> vstring;
typedef vector<int> vint;
typedef vector<vector<int>> vvint; 
// #include <unistd.h> 
#define pausa getchar();
#define rprintf( ... )({ char buffer[256000]; sprintf (buffer, __VA_ARGS__);  buffer; })
#define lop(var,from,to)for(int var=(from);var<(to);var++)
#define sleepms(val) std::this_thread::sleep_for(val##ms) 
#define cot(var) { \
	auto timeval = std::time(nullptr); \
    auto tm = *std::localtime(&timeval); \
    std::cout << std::put_time(&tm, "%H:%M:%S ") <<#var<<" "<<var<<endl; \
}
#endif

string elevator_current="2";
string elevator_pos="2";




void elevator(){
	ofstream os;
	os.open("frobot_elevatorcurr.txt", std::ofstream::out);
	os<<1;
	
	ifstream is;
	is.open("frobot_elevator.txt");
	if (is) { 
		char bf [2]; 
		bf[1]='\0'; 
		for(;;){
			is.seekg (0, is.beg);
			is.read (bf,1);
			cot(bf);
			if(elevator_current!=bf){
				printf("go from %s to %s\n",elevator_current.c_str(),bf);
				int to=atoi(bf);
				//stepper motor elevator
				//to=elevator_to(to);
				sleepms(4000); //simulation
				elevator_current=to_string(to);
				//could go by ssh
				ofstream os1;
				os1.open("frobot_elevatorcurr.txt", std::ofstream::out);
				os1<<to;
				os1.close();
			}
			sleepms(2000);
		}
		is.close(); 
	}
	os.close();
}
int elevator_to(int floor){
	sleepms(4000);
	return floor;
}
int main(int argc, char **argv){ 
	if(argc==3 && string(argv[1])=="elevator"){
		cout<<elevator_to(atoi(argv[2]))<<endl;
		return 0;
	}
	cout<<3<<endl;return 0;
	thread th([](){
		elevator();
	});
	th.detach();
	
	
	cot("ok");
	pausa
	return 0;
}