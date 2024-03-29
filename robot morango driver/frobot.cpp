// http://ahux.narod.ru/olderfiles/1/OSG3_Cookbook.pdf https://titanwolf.org/Network/Articles/Article?AID=306e6b2e-3e45-4cc2-8f86-3e674ff557c3#gsc.tab=0
//math collision detection two cubes https://gamedev.stackexchange.com/questions/60505/how-to-check-for-cube-collisions

#ifdef _WIN32
#include <windows.h>
// Use discrete GPU by default.
extern "C" {
	// http://developer.download.nvidia.com/devzone/devcenter/gamegraphics/files/OptimusRenderingPolicies.pdf
	__declspec(dllexport) DWORD NvOptimusEnablement = 0x00000001;

	// http://developer.amd.com/community/blog/2015/10/02/amd-enduro-system-for-developers/
	__declspec(dllexport) int AmdPowerXpressRequestHighPerformance = 1;
}
#endif

#if 1 //includes
#define GLEW_STATIC
// #include <GL/glew.h> 
// #include <GL/gl.h>
// #include <GL/glu.h>
// #include <GL/glcorearb.h>
// #include <GL/glext.h>  
// #include <GL/GLwDrawA.h>
// #include <GL/GLwDrawAP.h>
// #include <GL/glxext.h>
// #include <GL/glx.h>


#include <opencv2/opencv.hpp>
#include <stdio.h>
#include <iostream>
#include <functional>
#include <unordered_map> 
#include <algorithm> 
#include <FL/Fl.H>
#include <FL/Fl_Gl_Window.H>
#include <FL/Fl_Text_Editor.H>
#include <FL/Fl_Box.H>
#include <FL/Fl_Input.H>
#include <FL/Fl_Multiline_Input.H>
#include <FL/Fl_Scroll.H>
#include <Fl/Fl_Value_Slider.H>
#include <FL/Fl_Toggle_Button.H>
#include <FL/Fl_Double_Window.H>
#include <FL/Fl_Help_View.H>
// #include <FL/Fl_Browser.H>
#include <FL/Fl_Button.H> 
#include <FL/Fl_Choice.H>
#include <FL/Fl_Input_Choice.H>
// #include <FL/Fl_Tabs.H>
// #include <glm/glm.hpp>
// #include <glm/gtc/matrix_transform.hpp>
// #include <glm/gtc/type_ptr.hpp>

// #include <condition_variable>
#endif

#if 1 //common
#include <configuru.hpp>
using namespace configuru;
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
// #include "filesystem.hpp"
// #include "regular.hpp"
// #include "threads.hpp"
// #include "timef.hpp" 
// #include <unistd.h>
// #define replace_all(val,from,to) std::regex_replace(val, std::regex(from), to);
#define rprintf( ... )({ char buffer[256000]; sprintf (buffer, __VA_ARGS__);  buffer; })
#define lop(var,from,to)for(int var=(from);var<(to);var++)
#define sleepms(val) std::this_thread::sleep_for(val##ms)
#define pausa getchar();
// #include "arrayf.hpp"
// #include "stringf.hpp" 

template<typename T, typename ... Args>
void print_args(std::stringstream &ss, T first, Args ... args) {
    if constexpr (std::is_same_v<T, std::string>) {
        ss << first;
    } else {
        ss << first;
    }
    if constexpr (sizeof...(args) > 0) {
        ss << ", ";
        print_args(ss, args...);
    }
}
#define cotm(...) { \
    std::stringstream ss; \
    ss << #__VA_ARGS__ ; \
    vector<string> vv=split(ss.str(),",");\
    ss.str("");\
    auto timeval = std::time(nullptr); \
    auto tm = *std::localtime(&timeval); \
    cout << std::put_time(&tm, "%H:%M:%S ");\
    print_args(ss, __VA_ARGS__);\
    vector<string> vvv=split(ss.str(),",");\
    for(int i=0;i<vv.size();i++){\
    cout<< vv[i]<<"="<<vvv[i]<<"\t";}\    
    cout<<endl;\
} 



#define cot(var) { \
	auto timeval = std::time(nullptr); \
    auto tm = *std::localtime(&timeval); \
    std::cout << std::put_time(&tm, "%H:%M:%S ") <<#var<<" "<<var<<endl; \
}
#define cot ;
#define cot1(var) { \
	auto timeval_ = std::time(nullptr); \
    auto tm_ = *std::localtime(&timeval_); \
    std::cout << std::put_time(&tm_, "%H:%M:%S ") <<#var<<" "<<var<<endl; \
}

void replace_All(std::string & data, std::string toSearch, std::string replaceStr){
    // Get the first occurrence
    size_t pos = data.find(toSearch);
    // Repeat till end is reached
    while( pos != std::string::npos)
    {
        // Replace this occurrence of Sub String
        data.replace(pos, toSearch.size(), replaceStr);
        // Get the next occurrence from the current position
        pos =data.find(toSearch, pos + replaceStr.size());
    }
}
vector<string> split(const string& s, const string delim, const bool keep_empty=1) {
	vector<string> result;
	if (delim.empty()) {result.push_back(s);
	return result;}
	string::const_iterator substart = s.begin(), subend;while (true) {
		subend = search(substart, s.end(), delim.begin(), delim.end());	
		string temp(substart, subend);	if (keep_empty || !temp.empty()) {	
			result.push_back(temp);	}if (subend == s.end()) {break;	}
			substart = subend + delim.size();	}	
	return result;}

void* threadDetach(std::function<void()> tf){
    thread th(tf); 
    th.detach(); 
	return (void*)th.native_handle();
}
struct combR{
    bool cached=false;
    vector<unsigned int*> cache;
    vector<int> ranges;
    vector<int> restoR;
    unsigned long long range;
    int k;//=ranges.size();
    combR(){}
    ~combR(){}
    combR(int n,int K,bool tocache=false);
    combR(vector <int> Ranges,bool tocache=false);
    vector<int> toComb(unsigned int csn);
    void toComb(unsigned int csn,vector<int>&res);
    vvint toCombV(vint &hist);
    void toComb(int* res,unsigned int csn);
    unsigned long long combNumCombinIrregular();
    unsigned long long toCsn(int *comb);
};
combR::combR(int n,int K,bool tocache){
    k=K;
    ranges=vector<int>(k);
    for(int i=0;i<k;i++)ranges[i]=n;
    range = combNumCombinIrregular();
    restoR=ranges;
    for(int i=k-2;i>=0;i--)restoR[i]=ranges[i]*restoR[i+1];
    if(tocache){
        cache.resize(k);
        for(int c=0;c<k;c++)cache[c]=new unsigned int [range];
        for(unsigned int  i=0;i<range;i++){
            vector<int> cf=toComb(i);
            for(int c=0;c<k;c++)cache[c][i]=cf[c];
        }
        cached=true;
    }
}
combR::combR(vector <int> Ranges,bool tocache){
    ranges=Ranges;
    k=ranges.size();
    range = combNumCombinIrregular();
    restoR=ranges;
    for(int i=k-2;i>=0;i--)restoR[i]=ranges[i]*restoR[i+1];
    if(tocache){
        cache.resize(k);
        for(int c=0;c<k;c++)cache[c]=new unsigned int [range];
        for(unsigned int  i=0;i<range;i++){
            vector<int> cf=toComb(i);
            for(int c=0;c<k;c++)cache[c][i]=cf[c];
        }
        cached=true;
    }
}
vector<int> combR::toComb(unsigned int csn){
    vector<int>res(k);
    res[k-1]=csn%restoR[k-1];
    for(int i=0;i<k-1;i++)res[i]=csn/restoR[i+1]%ranges[i];
    return res;
}
void combR::toComb(unsigned int csn,vector<int>&res){
    res[k-1]=csn%restoR[k-1];
    for(int i=0;i<k-1;i++)res[i]=csn/restoR[i+1];
    for(int i=1;i<k-1;i++)res[i]%=ranges[i];
}
void combR::toComb(int* res,unsigned int csn){
    res[k-1]=csn%restoR[k-1];
    for(int i=0;i<k-1;i++)res[i]=csn/restoR[i+1];
    for(int i=1;i<k-1;i++)res[i]%=ranges[i];
}
unsigned long long combR::combNumCombinIrregular(){
    unsigned long long res=1;
    for(int i=0;i<ranges.size();i++)res*=ranges[i];
    return res;
}
unsigned long long  combR::toCsn(int *comb){
    unsigned long long pos = 0;
    unsigned long long rangeval = range;
    for (int l = 0; l < k; l++) {
        int figura = comb[l];
        unsigned long long sector = rangeval / ranges[l];
        rangeval = sector;
        pos += sector * figura;
    }
    return pos;
}
std::string exec(char* cmd) {
    FILE* pipe = popen(cmd, "r");
    if (!pipe) return "ERROR";
    char buffer[128];
    std::string result = "";
    while(!feof(pipe)) {
    	if(fgets(buffer, 128, pipe) != NULL)
    		result += buffer;
    }
    pclose(pipe);
    return result;
}
#endif

struct flocvs;
flocvs* flocv;

struct sshconnect;
sshconnect* ssh;
vector<vector<Fl_Button*>> btp;
struct vix{int index;float angle; };	
vector<vector<vix*>> vixs;



#if 1 //servo i2c
// https://community.element14.com/products/devtools/single-board-computers/b/blog/posts/maaxboard-setup-for-servo-pwm-control-with-python permissions
// https://www.jetsonhacks.com/2019/07/22/jetson-nano-using-i2c/
// https://learn.adafruit.com/16-channel-pwm-servo-driver?view=all
// https://forums.raspberrypi.com/viewtopic.php?t=260395

// Map an integer from one coordinate system to another
// This is used to map the servo values to degrees
// e.g. map(90,0,180,servoMin, servoMax)
// Maps 90 degrees to the servo value
int pmap ( int x, int in_min, int in_max, int out_min, int out_max) {
    int toReturn =  (x - in_min) * (out_max - out_min) / (in_max - in_min) + out_min ;
    // For debugging:
    // printf("MAPPED %d to: %d\n", x, toReturn);
    return toReturn ;
}
#endif

#if 1 //stepper carril
// https://www.instructables.com/Raspberry-Pi-Python-and-a-TB6600-Stepper-Motor-Dri/

#endif


#if 1 //Gpio
// https://developer.ridgerun.com/wiki/index.php/Gpio-int-test.c
// https://github.com/jetsonhacks/JHPWMDriver/blob/master/src/JHPWMPCA9685.h
// https://www.jetsonhacks.com/2019/07/22/jetson-nano-using-i2c/
// https://forums.raspberrypi.com/viewtopic.php?t=327125
// https://crish4cks.net/a-simple-c-library-to-drive-a-stepper-motor-using-the-raspberry-pi/
#if __linux__
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <errno.h>
#include <unistd.h>
#include <fcntl.h>
#include <poll.h>

 /****************************************************************
 * Constants
 ****************************************************************/
 
#define SYSFS_GPIO_DIR "/sys/class/gpio"
#define POLL_TIMEOUT (3 * 1000) /* 3 seconds */
#define MAX_BUF 64

/****************************************************************
 * gpio_export
 ****************************************************************/
int gpio_export(unsigned int gpio)
{
	int fd, len;
	char buf[MAX_BUF];
 
	fd = open(SYSFS_GPIO_DIR "/export", O_WRONLY);
	if (fd < 0) {
		perror("gpio/export");
		return fd;
	}
 
	len = snprintf(buf, sizeof(buf), "%d", gpio);
	write(fd, buf, len);
	close(fd);
 
	return 0;
}

/****************************************************************
 * gpio_unexport
 ****************************************************************/
int gpio_unexport(unsigned int gpio)
{
	int fd, len;
	char buf[MAX_BUF];
 
	fd = open(SYSFS_GPIO_DIR "/unexport", O_WRONLY);
	if (fd < 0) {
		perror("gpio/export");
		return fd;
	}
 
	len = snprintf(buf, sizeof(buf), "%d", gpio);
	write(fd, buf, len);
	close(fd);
	return 0;
}

/****************************************************************
 * gpio_set_dir
 ****************************************************************/
int gpio_set_dir(unsigned int gpio, unsigned int out_flag)
{
	int fd, len;
	char buf[MAX_BUF];
 
	len = snprintf(buf, sizeof(buf), SYSFS_GPIO_DIR  "/gpio%d/direction", gpio);
 
	fd = open(buf, O_WRONLY);
	if (fd < 0) {
		perror("gpio/direction");
		return fd;
	}
 
	if (out_flag)
		write(fd, "out", 4);
	else
		write(fd, "in", 3);
 
	close(fd);
	return 0;
}

/****************************************************************
 * gpio_set_value
 ****************************************************************/
int gpio_set_value(unsigned int gpio, unsigned int value)
{
	int fd, len;
	char buf[MAX_BUF];
 
	len = snprintf(buf, sizeof(buf), SYSFS_GPIO_DIR "/gpio%d/value", gpio);
 
	fd = open(buf, O_WRONLY);
	if (fd < 0) {
		perror("gpio/set-value");
		return fd;
	}
 
	if (value)
		write(fd, "1", 2);
	else
		write(fd, "0", 2);
 
	close(fd);
	return 0;
}

/****************************************************************
 * gpio_get_value
 ****************************************************************/
int gpio_get_value(unsigned int gpio, unsigned int *value)
{
	int fd, len;
	char buf[MAX_BUF];
	char ch;

	len = snprintf(buf, sizeof(buf), SYSFS_GPIO_DIR "/gpio%d/value", gpio);
 
	fd = open(buf, O_RDONLY);
	if (fd < 0) {
		perror("gpio/get-value");
		return fd;
	}
 
	read(fd, &ch, 1);

	if (ch != '0') {
		*value = 1;
	} else {
		*value = 0;
	}
 
	close(fd);
	return 0;
}


/****************************************************************
 * gpio_set_edge
 ****************************************************************/

int gpio_set_edge(unsigned int gpio, char *edge)
{
	int fd, len;
	char buf[MAX_BUF];

	len = snprintf(buf, sizeof(buf), SYSFS_GPIO_DIR "/gpio%d/edge", gpio);
 
	fd = open(buf, O_WRONLY);
	if (fd < 0) {
		perror("gpio/set-edge");
		return fd;
	}
 
	write(fd, edge, strlen(edge) + 1); 
	close(fd);
	return 0;
}

/****************************************************************
 * gpio_fd_open
 ****************************************************************/

int gpio_fd_open(unsigned int gpio)
{
	int fd, len;
	char buf[MAX_BUF];

	len = snprintf(buf, sizeof(buf), SYSFS_GPIO_DIR "/gpio%d/value", gpio);
 
	fd = open(buf, O_RDONLY | O_NONBLOCK );
	if (fd < 0) {
		perror("gpio/fd_open");
	}
	return fd;
}

 
int gpio_fd_close(int fd)
{
	return close(fd);
}
 
int gpio(int argc, char **argv, char **envp)
{
	struct pollfd fdset[2];
	int nfds = 2;
	int gpio_fd, timeout, rc;
	char *buf[MAX_BUF];
	unsigned int gpio;
	int len;



	if (argc < 2) {
		printf("Usage: gpio-int <gpio-pin>\n\n");
		printf("Waits for a change in the GPIO pin voltage level or input on stdin\n");
		exit(-1);
	}

	gpio = atoi(argv[1]);

	gpio_export(gpio);
	gpio_set_dir(gpio, 0);
	gpio_set_edge(gpio, "rising");
	gpio_fd = gpio_fd_open(gpio);

	timeout = POLL_TIMEOUT;
 
	while (1) {
		memset((void*)fdset, 0, sizeof(fdset));

		fdset[0].fd = STDIN_FILENO;
		fdset[0].events = POLLIN;
      
		fdset[1].fd = gpio_fd;
		fdset[1].events = POLLPRI;

		rc = poll(fdset, nfds, timeout);      

		if (rc < 0) {
			printf("\npoll() failed!\n");
			return -1;
		}
      
		if (rc == 0) {
			printf(".");
		}
            
		if (fdset[1].revents & POLLPRI) {
			lseek(fdset[1].fd, 0, SEEK_SET);
			len = read(fdset[1].fd, buf, MAX_BUF);
			printf("\npoll() GPIO %d interrupt occurred\n", gpio);
		}

		if (fdset[0].revents & POLLIN) {
			(void)read(fdset[0].fd, buf, 1);
			printf("\npoll() stdin read 0x%2.2X\n", atoi(buf[0]));
		}

		fflush(stdout);
	}

	gpio_fd_close(gpio_fd);
	return 0;
}
#endif
#endif



//osg
#if 1
#include <osg/io_utils>
#include <osgViewer/Viewer>
// #include <osgViewer/CompositeViewer>
#include <osgViewer/ViewerEventHandlers>
#include <osgGA/TrackballManipulator>
#include <osgGA/NodeTrackerManipulator>
#include <osgGA/OrbitManipulator>
#include <osgDB/ReadFile>
#include <osg/AlphaFunc>
#include <osg/BlendFunc>
#include <osg/Depth>
// #include <osg/Geode>
#include <osg/Material>
#include <osg/LOD>
#include <osg/Math>
#include <osg/MatrixTransform>
#include <osg/PolygonOffset>
#include <osg/Projection>
// #include <osg/ShapeDrawable>
// #include <osg/Texture2D>
// #include <osg/TextureBuffer>
// #include <osg/Image>
// #include <osg/Texture2DArray>
// #include <osg/Multisample> 
#include <osg/LineWidth>  
// #include <osg/Camera>
#include <osg/PositionAttitudeTransform>
#include <osg/ComputeBoundsVisitor>
using namespace osg;

struct Fl_Double_Windowc : public Fl_Double_Window{
	Fl_Double_Windowc(int x, int y, int w, int h, const char *label=0): Fl_Double_Window(x, y, w, h, label){ 
	}
    ~Fl_Double_Windowc() {}	  
 
	virtual int handle(int event){
		// cot(event);
		// cot(FL_KEYDOWN);
				// cot( Fl::event_key());
	// cot(Fl::get_key);
				return Fl_Double_Window::handle(event);
	}
};

struct AdapterWidget : public Fl_Gl_Window{
	AdapterWidget(int x, int y, int w, int h, const char *label=0): Fl_Gl_Window(x, y, w, h, label){
		_gw = new osgViewer::GraphicsWindowEmbedded(x,y,w,h);
	}
    ~AdapterWidget() {}	
    osg::ref_ptr<osgViewer::GraphicsWindowEmbedded> _gw;
    osgViewer::GraphicsWindow* getGraphicsWindow() { return _gw.get(); }
    const osgViewer::GraphicsWindow* getGraphicsWindow() const { return _gw.get(); }
	void resize(int x, int y, int w, int h){
		_gw->getEventQueue()->windowResize(x, y, w, h );
		_gw->resized(x,y,w,h);
		Fl_Gl_Window::resize(x,y,w,h);
	}
	virtual int handle(int event){ 
	// return Fl_Gl_Window::handle(event);
		// cot(event);
		// cot(FL_KEYDOWN);
				// cot( Fl::event_key());
	// cot(Fl::get_key);
				// return Fl_Gl_Window::handle(event);
		if(event==3)Fl::focus(this);
		switch(event){
			case FL_PUSH:
				_gw->getEventQueue()->mouseButtonPress(Fl::event_x(), Fl::event_y(), Fl::event_button());
				return 1;
			case FL_MOVE:
			case FL_DRAG:
				_gw->getEventQueue()->mouseMotion(Fl::event_x(), Fl::event_y());
				return 1;
			case FL_RELEASE:
				_gw->getEventQueue()->mouseButtonRelease(Fl::event_x(), Fl::event_y(), Fl::event_button());
				return 1;
			case FL_KEYDOWN:
				// _gw->getEventQueue()->keyPress((osgGA::GUIEventAdapter::KeySymbol)Fl::event_key());
				return Fl_Gl_Window::handle(event);
			case FL_KEYUP:
				// _gw->getEventQueue()->keyRelease((osgGA::GUIEventAdapter::KeySymbol)Fl::event_key());
				return Fl_Gl_Window::handle(event);
			default:
				// pass other events to the base class
				return Fl_Gl_Window::handle(event);
		}
	};
};
struct ViewerFLTK : public osgViewer::Viewer, public AdapterWidget{
	static void Timer_CB(void *userdata) {
        ViewerFLTK *pb = (ViewerFLTK*)userdata; 
        pb->redraw(); 
        Fl::repeat_timeout(1.0/24, Timer_CB, userdata);
    }
    ViewerFLTK(int x, int y, int w, int h, const char *label=0):
            AdapterWidget(x,y,w,h,label) {
				Fl::add_timeout(1.0/24.0, Timer_CB, (void*)this);
                getCamera()->setViewport(new osg::Viewport(0,0,w,h));
                getCamera()->setProjectionMatrixAsPerspective(30.0f, static_cast<double>(w)/static_cast<double>(h), 1.0f, 10000.0f);
                getCamera()->setGraphicsContext(getGraphicsWindow());
                getCamera()->setDrawBuffer(GL_BACK);
                getCamera()->setReadBuffer(GL_BACK);
                setThreadingModel(osgViewer::Viewer::SingleThreaded);
            }
        void draw() { 
			frame();
		}
	// virtual int handle(int event){
		// cot(event);
		// cot(FL_KEYDOWN);
				// cot( Fl::event_key());
				// return Fl_Gl_Window::handle(event);
	// }

};

#include <sqlite3.h>
sqlite3* sql3;
Fl_Double_Window* win;
Fl_Double_Window* flt; 
Fl_Double_Window* flbd; 
ViewerFLTK* osggl;
unordered_map<string,osg::ref_ptr<osg::Node>> stlgroup;
osg::Group* group = new osg::Group(); 
struct osgdr;
vector<osgdr*> ve;
osgdr* carril;
vector<std::mutex> mut=vector<std::mutex>(10);

void settranparency(Node* model,bool val=1){
	osg::StateSet* state2 = model->getOrCreateStateSet();
	state2->clear();	
	osg::ref_ptr<osg::Material> mat2 = new osg::Material;
	mat2->setAlpha(osg::Material::FRONT_AND_BACK, 0.5); //Making alpha channel
	state2->setAttributeAndModes( mat2.get() ,osg::StateAttribute::ON | osg::StateAttribute::OVERRIDE);
	if(!val)return;
	osg::BlendFunc* bf = new osg::BlendFunc(osg::BlendFunc::SRC_ALPHA,osg::BlendFunc::ONE_MINUS_DST_COLOR );
	state2->setAttributeAndModes(bf);  
	model->getStateSet()->setMode( GL_BLEND, osg::StateAttribute::ON );
	model->getStateSet()->setRenderingHint( osg::StateSet::TRANSPARENT_BIN );
}



void setalpha(Node* model,float val=0.9){
// https://groups.google.com/g/osg-users/c/APGaJ_5icx8
	osg::StateSet* state2 = model->getOrCreateStateSet(); //Creating material
	osg::ref_ptr<osg::Material> mat2 = new osg::Material;

	mat2->setAlpha(osg::Material::FRONT_AND_BACK, 0.5); //Making alpha channel
	state2->setAttributeAndModes( mat2.get() ,osg::StateAttribute::ON | osg::StateAttribute::OVERRIDE);
	
	osg::BlendFunc* bf = new                        //Blending
	osg::BlendFunc(osg::BlendFunc::SRC_ALPHA,
	osg::BlendFunc::ONE_MINUS_DST_COLOR );
	state2->setAttributeAndModes(bf);  
	model->getStateSet()->setMode( GL_BLEND, osg::StateAttribute::ON );
	model->getStateSet()->setRenderingHint( osg::StateSet::TRANSPARENT_BIN ); 
	
	
	state2->clear();
	state2->setAttributeAndModes( mat2.get() ,osg::StateAttribute::ON | osg::StateAttribute::OVERRIDE);

	
}
#endif

osgGA::TrackballManipulator* tmr;
typedef osg::Vec3f vec3f; 
typedef osg::Vec3f vec3; 
#define Pi 3.141592653589793238462643383279502884L
#define Pi180 0.01745329251

bool posa_debug=0;
bool dbg_force=0; 
vvfloat posapool;
struct posv{ vfloat p; vec3 topoint; float x; float y; float z; int posa_counter=0; bool cancel=0; int funcn=0; vbool lock_angle={};  bool pause=0; };
vector<posv*> pool;
std::mutex first_mtx;
std::mutex posa_mtx;
mutex posa_counter_mtx;
mutex posa_erase_mtx; 
float pressuref=2;
vector<vec3> pressure_at;

float distance_two_points(vec3* point1,vec3* point2){
	// cot(*point2);
	return sqrt( pow(point2->x()-point1->x(),2) +pow(point2->y()-point1->y(),2) +pow(point2->z()-point1->z(),2)    );	
}

vector<vec3> segments_3d(vec3 p1,vec3 p2, int segments=10){
	vector<vec3> res(segments+1);
	float xx=p2.x()-p1.x();
	float yy=p2.y()-p1.y();
	float zz=p2.z()-p1.z();
	float m;
	lop(i,0,segments+1){
		m=i/(float)segments;
		res[i].x()=p1.x()+xx*m;
		res[i].y()=p1.y()+yy*m;
		res[i].z()=p1.z()+zz*m;
	}
	return res;
}

void bound_box();
void dbg_pos();
void copy_points_k();
void arm_len_fill();
void movz_ik(float z);
struct osgdr{
	int index=0;
	vec3* offset=0;
	float angle=0;
	float anglestart=0;
	float anglemax=0;
	float anglemin=0;
	int dir=1;
	int rotatedir=1;
	float angleik=0;
	float arm_len=0;
	bool moving=0;
	vec3 *axisbegin;
	vec3 *axisend;
	vec3 axis;
	vec3 *axisbeginik;
	vec3 *axisendik;
	vector<osg::ref_ptr<osg::Node>> nodes;
	vstring nodesstr;
	osg::ref_ptr<osg::Vec3Array> points = new osg::Vec3Array;
	osg::ref_ptr<osg::Vec3Array> pointsik = new osg::Vec3Array;;
	osg::ref_ptr<osg::Vec4Array> color = new osg::Vec4Array;
	osg::ref_ptr<osg::Geometry> geometry= new osg::Geometry; 
    MatrixTransform* transform = new osg::MatrixTransform;
	DrawArrays* drw=new osg::DrawArrays;
	// osg::ComputeBoundsVisitor* cbv=new osg::ComputeBoundsVisitor;
	osgdr(Group* group){	
		group->addChild( transform); 
		group->addChild( geometry);
	}
	void newdr(vec3 _axisbegin=vec3(30,0,0),vec3 _axisend=vec3(0,0,0) ){
		index=ve.size()-1;
		// cot(index);
		points->push_back(_axisbegin);
		points->push_back(_axisend);
		axisbegin=&points[0][0];
		axisend=&points[0][1];
		color->push_back(osg::Vec4(1.0,0.0,0.0,1.0));
		// color->push_back(osg::Vec4(1.0,0.0,0.0,1.0));
		geometry ->setVertexArray(points.get());
		geometry ->setColorArray(color.get());
		geometry ->setColorBinding(osg::Geometry::BIND_PER_PRIMITIVE_SET);
		// geometry ->setColorBinding(osg::Geometry::BIND_PER_VERTEX);
		// geometry ->setColorBinding(osg::Geometry::BIND_OVERALL);
		geometry ->addPrimitiveSet(new osg::DrawArrays(GL_LINES,0, points->size()));
		osg::LineWidth* linew = new osg::LineWidth(5);
		geometry->getOrCreateStateSet()->setAttributeAndModes(linew);
		// transform->addChild(geometry);
		
		lop(i,0,nodesstr.size()){
			nodes.push_back(osgDB::readRefNodeFile(nodesstr[i]));
			settranparency(nodes[i].get(),0);
			transform->addChild(nodes[i].get());
			// transform->accept(*cbv);
		}
		// arm_len_fill();
		
		//pointsik init
		// pointsik = new osg::Vec3Array;
		// pointsik->push_back(points[0][0]);
		// pointsik->push_back(points[0][1]); 
		// axisbeginik=&pointsik[0][0];
		// axisendik=&pointsik[0][1];
		
		// dbg_pos();
		// cot(*axisbegin);
		// cot(*axisbeginik);
	}
	
	void gooffset(){
		if(offset==0)offset=new vec3(0,0,0);
		
	}
	

	
	void rotate_pos(float newangle){	 
		float nangle=angle-newangle; 
		rotate(nangle*-1);
	}
	void rotate_posk(float newangle){	
		float nangle=angleik-newangle; 
		rotateik(nangle*-1);
	}
	//ve[index]-> == this
	//posa
	void rotatetoposition(float newangle, posv* pov,bool manual=0){	
		thread th([&](float newangle, posv* pov ){
			if(pov->pause){
				while(pov->pause)sleepms(200);
			}
			float precision=1;
			if(moving==1){
				// moving=0;
			}
			if(!manual)mut[index+1].lock();
			moving=1;
			if(pov->cancel)moving=0;
			// cot(angle);
			// cot(newangle);
			// if(newangle>anglemax)return;
			mut[9].lock();
			// mtxlock(9);
			float nangle=newangle-angle;
			// cot(index);
			// cot(newangle);
			// cot(angle);
			// cot(nangle);
			mut[9].unlock();
			// mtxunlock(9);
			// cot(anglemax);
			// rotate( nangle);
			if(nangle>0){
				float dir=1*precision;
				for(;;){			
					if(pressuref>2){
						cot1("W")
						pov->cancel=1;
						pressure_at.push_back(*ve[4]->axisend);
						cot1(pressure_at.back());
					}	
					if(pov->cancel==1)break;		
					if(pov->pause){
						while(pov->pause)sleepms(200);
					}
					if(moving==0)break;
					if(angle>anglemax)break;
					if(nangle<=0.1)break;
					rotate( dir);
					// cot(nangle);
					// cot(angle);
					nangle-=dir;
					sleepms(20);
				
				}
			}
			if(nangle<0){
				float dir=-1*precision;
				for(;;){					
					if(pov->cancel==1)break;		
					if(pov->pause){
						while(pov->pause)sleepms(200);
					}
					if(moving==0)break;
					if(angle<anglemin)break;
					if(nangle>=-0.1)break;
					rotate( dir);
					nangle-=dir;
					sleepms(20);
				
				}
			}
			moving=0;
			if(!manual)mut[index+1].unlock();
				posa_counter_mtx.lock();
				pov->posa_counter--;
				// cot(posa_counter);
				posa_counter_mtx.unlock();
				// dbg_pos();
		},newangle,pov);
		th.detach( ); 
		
	
	} 
	void rotate( float _angle ){
	// cot(_angle);
		if(_angle==0)return;
		// mtxlock(0);
		first_mtx.lock();
		// cot(index);
		// cot(angle);
		// lop(i,0,ve.size()) cout<<i<<" "<<ve[i]->angle<<"  ";cout<<endl;
		// cot(axisb.length());
		// if(axisb.length()==0)
		vec3 axisb=*axisbegin; 
		// angle+=_angle;
		// cot(angle);
		 		
		osg::Matrix Tr;
		Tr.makeTranslate( axisb.x(),axisb.y(),axisb.z() );
		osg::Matrix T; 
		T.makeTranslate( -axisb.x(),-axisb.y(),-axisb.z() ); 
		 
		lop(i,0,index) {		
			osg::Matrix Ra; 
			Ra.makeRotate( Pi180*-ve[i]->angle, ve[i]->axis ); 
			lop(j,0,points[0].size())points[0][j] = points[0][j]   * T * Ra * Tr   ; 
			transform->setMatrix(transform->getMatrix()   * T * Ra * Tr ); 
		}
		osg::Matrix R; 
		R.makeRotate( Pi180*_angle*rotatedir, axis ); 	 
		lop(j,0,points[0].size())points[0][j] = points[0][j] * T * R * Tr  ; 
		transform->setMatrix(transform->getMatrix()   * T  *  R  * Tr   ); 
		 
		for(int i=index-1;i>=0;i--)	{ 
			osg::Matrix Ra; 
			Ra.makeRotate( Pi180*ve[i]->angle, ve[i]->axis ); 
			lop(j,0,points[0].size())points[0][j] = points[0][j]    * T * Ra * Tr   ; 
			transform->setMatrix(transform->getMatrix()   * T * Ra * Tr    );
		} 
		drw->dirty();
		drw->set(GL_LINES,0, points->size());
		geometry ->setPrimitiveSet(0,drw); 
		
		//todas as posteriores teem que rodar tambem 
		lop(i,index+1,ve.size()-0){
			// cot(ve[i]->nodesstr);
				 
			lop(jj,0,index)	{		
				osg::Matrix Ra; 
				Ra.makeRotate( Pi180*-ve[jj]->angle, ve[jj]->axis ); 
				lop(j,0,ve[i]->points[0].size())ve[i]->points[0][j] = ve[i]->points[0][j]   * T * Ra * Tr   ; 
				ve[i]->transform->setMatrix(ve[i]->transform->getMatrix()   * T * Ra * Tr ); 
			}
			
			ve[i]->transform->setMatrix(ve[i]->transform->getMatrix()   * T * R * Tr   );
			lop(j,0,ve[i]->points[0].size()){ 
				ve[i]->points[0][j] = ve[i]->points[0][j]   * T * R * Tr   ;  
			}
			
			for(int jj=index-1;jj>=0;jj--)	{		
				osg::Matrix Ra; 
				Ra.makeRotate( Pi180*ve[jj]->angle, ve[jj]->axis ); 
				lop(j,0,ve[i]->points[0].size())ve[i]->points[0][j] = ve[i]->points[0][j]   * T * Ra * Tr   ; 
				ve[i]->transform->setMatrix(ve[i]->transform->getMatrix()   * T * Ra * Tr ); 
			}
			
			ve[i]->drw->dirty();
			ve[i]->drw->set(GL_LINES,0, ve[i]->points->size());
			ve[i]->geometry ->setPrimitiveSet(0,ve[i]->drw); 
		}

		// transform->accept(*cbv);
		angle+=_angle;
		
		//modulo float
		angle = angle - int( angle/360.0 )*360.0 ;
		
		
		
		//acende luz no fk 
		int ang10=angle/10*10;
		lop(i,0,vixs[index].size()){
			if((int)vixs[index][i]->angle==ang10){ 
				lop(j,0,vixs[index].size())if(btp[index][j]->color()!=FL_GRAY){
					btp[index][j]->color(FL_GRAY );
					btp[index][j]->redraw();				
				}
				btp[index][i]->color(FL_GREEN);
				btp[index][i]->redraw();
			}
		}
		dbg_pos();
		// bound_box();
		// first_mtx.unlock();
		first_mtx.unlock();
	};
	void rotateik( float _angle ){   
		vec3 axisb=*axisbeginik;  
		 		
		osg::Matrix Tr;
		Tr.makeTranslate( axisb.x(),axisb.y(),axisb.z() );
		osg::Matrix T; 
		T.makeTranslate( -axisb.x(),-axisb.y(),-axisb.z() ); 
		
		lop(i,0,index){		
			osg::Matrix Ra; 
			Ra.makeRotate( Pi180*-ve[i]->angleik, ve[i]->axis ); 
			lop(j,0,pointsik[0].size())pointsik[0][j] = pointsik[0][j]   * T * Ra * Tr   ; 
			// transform->setMatrix(transform->getMatrix()   * T * Ra * Tr ); 
		}
		osg::Matrix R; 
		R.makeRotate( Pi180*_angle*rotatedir, axis ); 	 
		lop(j,0,pointsik[0].size())pointsik[0][j] = pointsik[0][j] * T * R * Tr  ; 
		// transform->setMatrix(transform->getMatrix()   * T * R * Tr   );
		 
		for(int i=index-1;i>=0;i--)	{ 
			osg::Matrix Ra; 
			Ra.makeRotate( Pi180*ve[i]->angleik, ve[i]->axis ); 
			lop(j,0,pointsik[0].size())pointsik[0][j] = pointsik[0][j]    * T * Ra * Tr   ; 
			// transform->setMatrix(transform->getMatrix()   * T * Ra * Tr    );
		} 
   
		//todas as posteriores teem que rodar tambem 
		lop(i,index+1,ve.size()-0){
			// cot(ve[i]->nodesstr);
				 
			lop(jj,0,index)	{		
				osg::Matrix Ra; 
				Ra.makeRotate( Pi180*-ve[jj]->angleik, ve[jj]->axis ); 
				lop(j,0,ve[i]->pointsik[0].size())ve[i]->pointsik[0][j] = ve[i]->pointsik[0][j]   * T * Ra * Tr   ; 
				// ve[i]->transform->setMatrix(ve[i]->transform->getMatrix()   * T * Ra * Tr ); 
			}
			
			// ve[i]->transform->setMatrix(ve[i]->transform->getMatrix()   * T * R * Tr   );
			lop(j,0,ve[i]->pointsik[0].size()){ 
				ve[i]->pointsik[0][j] = ve[i]->pointsik[0][j]   * T * R * Tr   ;  
			}
			
			for(int jj=index-1;jj>=0;jj--)	{		
				osg::Matrix Ra; 
				Ra.makeRotate( Pi180*ve[jj]->angleik, ve[jj]->axis ); 
				lop(j,0,ve[i]->pointsik[0].size())ve[i]->pointsik[0][j] = ve[i]->pointsik[0][j]   * T * Ra * Tr   ; 
				// ve[i]->transform->setMatrix(ve[i]->transform->getMatrix()   * T * Ra * Tr ); 
			}
			
			// ve[i]->drw->dirty();
			// ve[i]->drw->set(GL_LINES,0, ve[i]->points->size());
			// ve[i]->geometry ->setPrimitiveSet(0,ve[i]->drw); 
		}

		angleik+=_angle;
 
	}; 

	//returns angles to given point
	// posv posik(vec3 topoint,float x=0,float y=0,float z=1000){
	posv posik(vec3 topoint, vbool lock_angle={}){
		copy_points_k();
		// dbg_force=1;
		// dbg_pos();
		// posa_debug=0;
		float precision=1;
		int sz=ve.size(); 
		vfloat angles(sz);
		lop(i,0,ve.size())
			angles[i]=ve[i]->angle;
		sz+=1; ///eixo z, depois implementar o x e o y
		// vec3 axisb=*axisbegin;
		#define cdist distance_two_points(&topoint,axisendik)
		 
		// cot(axisb);
		// cot(arm_len);
		// lop(i,0,ve.size())cout<<ve[i]->arm_len<<" ";cout<<endl;
		// cot(*axisendik)
		// cot(*axisend) 
		float ld=cdist;
		vfloat cdir(sz);
		lop(i,0,sz)cdir[i]=precision;  //aqui o z tem a mesma precisao k a rotaçao
		// cdir[sz-1]=-20;
		for(int wi=0;wi<1000;wi++){
			for(int vi=sz-2;vi>=0;vi--){ //-2 é o z //o ultimo n tem angulo
			// cot1(lock_angle[vi]);
				if(lock_angle[vi])continue;
				if(vi<sz-1)if( ve[vi]->angleik >  ve[vi]->anglemax || ve[vi]->angleik <  ve[vi]->anglemin ){ 
					cdir[vi]*=-1;
					ve[vi]->rotateik(cdir[vi]*1);
				}
				ve[vi]->rotateik(cdir[vi]);
				if(ld<=cdist){
					cdir[vi]*=-1;
					ve[vi]->rotateik(cdir[vi]); 
				}  
				// cot(ve[vi]->angle);
				angles[vi]=ve[vi]->angleik;
				// cot(vi)
				// pausa
				// cot(angles);
			}
			movz_ik(cdir[sz-1]);
			if(ld<=cdist){
				cdir[sz-1]*=-1;
				movz_ik(cdir[sz-1]); 
			}  
			
			ld=cdist;
			// cot(ld);
			// if(wi%100==0) cot(ld);
			// cot(cdir);
			// cot(angles);
			if(wi%3500==0){
				lop(i,0,sz)cdir[i]=precision;
			}
		}
		// cot(ld);
		// cot(angles);
		// cot(*axisendik)
		// cot(*axisend)
		posv res;
		res.p=angles;
		// res.z=1000;
		res.z=ve[0]->axisbeginik->z();
		// posv r(angles,{},0,0,0);
		return res;
	}
};

void arm_len_fill(){
	lop(i,0,ve.size()-1){
		ve[i]->arm_len=distance_two_points(ve[i]->axisbegin,ve[i+1]->axisbegin);
		cot(ve[i]->arm_len);
	}
}

Fl_Help_View* fldbg;
stringstream strm;
void dbg_pos(){
	strm.str(std::string());
	// strm<<"\t"<<"axisbx\taxisby\taxisbz\t"<<"axisex\taxisey\taxisez\t"<<endl;
	lop(i,0,ve.size()){
		if(i>=0 && i<=3)strm<<"idx"<<i<<"\t"<<(int)(ve[i]->axisbegin->x())<<",\t"<<(int)(ve[i]->axisbegin->y())<<",\t"<<(int)(ve[i]->axisbegin->z());
		strm<<"<br>";
		if(i==4)strm<<"idxend"<<i<<"\t"<<(int)(ve[i]->axisend->x())<<"\t"<<(int)(ve[i]->axisend->y())<<"\t"<<(int)(ve[i]->axisend->z())<<endl;;
	}
	fldbg->value(strm.str().c_str());
	
	
	
	if(!posa_debug && dbg_force==0) return;
	dbg_force=0;
	// arm_len_fill();
	// lop(i,0,ve.size()) cout<<i<<" "<<ve[i]->angle<<"  ";cout<<endl; 
	cout<<"posa: "; lop(i,0,ve.size()) cout<<i<<","<<ve[i]->angle<<"  ";cout<<endl;		
	cout<<"posa( "; lop(i,0,ve.size()-1) cout<<ve[i]->angle<<" , "; cout<<ve.back()->angle<<" )"; cout<<endl;		
	
	
	cout<<"\t"<<"axisbx\taxisby\taxisbz\t"<<"axisex\taxisey\taxisez\t"<<endl;
	lop(i,0,ve.size()){
		cout<<"idx"<<i<<"\t"<<(int)(ve[i]->axisbegin->x())<<"\t"<<(int)(ve[i]->axisbegin->y())<<"\t"<<(int)(ve[i]->axisbegin->z())<<"\t"<<(int)(ve[i]->axisend->x())<<"\t"<<(int)(ve[i]->axisend->y())<<"\t"<<(int)(ve[i]->axisend->z())<<endl;;
	} 
	cot(distance_two_points(ve[1]->axisbegin,ve[3]->axisbegin) );
		cout<<"posak( "; lop(i,0,ve.size()-1) cout<<ve[i]->angleik<<" , "; cout<<ve.back()->angleik<<" )"; cout<<endl;
		cout<<"\t"<<"axisbx\taxisby\taxisbz\t"<<"axisex\taxisey\taxisez\t"<<"axisbxk\taxisbyk\taxisbzk\t"<<"axisexk\taxiseyk\taxisezk\t"<<endl;
		lop(i,0,ve.size()){
			cout<<"idx"<<i<<"\t"<<(int)(ve[i]->axisbegin->x())<<"\t"<<(int)(ve[i]->axisbegin->y())<<"\t"<<(int)(ve[i]->axisbegin->z())<<"\t"<<(int)(ve[i]->axisend->x())<<"\t"<<(int)(ve[i]->axisend->y())<<"\t"<<(int)(ve[i]->axisend->z())<<"\t"<<(int)(ve[i]->axisbeginik->x())<<"\t"<<(int)(ve[i]->axisbeginik->y())<<"\t"<<(int)(ve[i]->axisbeginik->z())<<"\t"<<(int)(ve[i]->axisendik->x())<<"\t"<<(int)(ve[i]->axisendik->y())<<"\t"<<(int)(ve[i]->axisendik->z())<<endl;;
		} 
		cout<<"Z "<<ve[0]->axisbegin->z()<<endl;
		cout<<"posaik( ";   cout<<std::round(ve[4]->axisend->x())<<" , "<<std::round(ve[4]->axisend->y())<<" , "<<std::round(ve[4]->axisend->z())<<" )"; cout<<endl;
}
//tem de copiar tambem o angulo
void copy_points_k(){ 
	lop(i,0,ve.size()){ 
		ve[i]->pointsik->clear();
		ve[i]->pointsik->push_back(ve[i]->points[0][0]);
		ve[i]->pointsik->push_back(ve[i]->points[0][1]); 
		ve[i]->axisbeginik=&ve[i]->pointsik[0][0];
		ve[i]->axisendik=&ve[i]->pointsik[0][1]; 
		ve[i]->angleik=ve[i]->angle;
	}
}
void pos_k(vfloat angles){ 
	lop(i,0,angles.size()){ 
		ve[i]->rotate_posk(angles[i]);
	}
	
}

void goffset(vec3* offset){
	osg::Matrix Trf;
	Trf.makeTranslate( offset->x(),offset->y(),offset->z() );
	lop(i,0,ve.size()){
		ve[i]->transform->setMatrix(ve[i]->transform->getMatrix() *  Trf );		
		lop(j,0,ve[i]->points[0].size())ve[i]->points[0][j] = ve[i]->points[0][j]  * Trf  ; //points axisbegin actualiza
		ve[i]->drw->dirty();
		ve[i]->drw->set(GL_LINES,0, ve[i]->points->size());
		ve[i]->geometry ->setPrimitiveSet(0,ve[i]->drw); 
	}
	//carril
	// carril->transform->setMatrix(carril->transform->getMatrix() *  Trf );	
	
	copy_points_k();
}

 void movz_ik(float z){
	if(abs(z)<3)return; //evitate tremelics
	osg::Matrix Trf;
	Trf.makeTranslate( 0,0,z );	
	lop(i,0,ve.size())	
		lop(j,0,ve[i]->pointsik[0].size())ve[i]->pointsik[0][j] = ve[i]->pointsik[0][j]  * Trf  ;

}
std::mutex sec_mut;
void movetoposz(float z, posv* pov){
	thread th([](float z, posv* pov){
		float currz=(float)((*ve[0]->axisbegin).z());
		// if(abs(currz-z)<3)return; //evitate tremelics
		float rz=z-currz;
		float speed=2;
		// cot (currz);
		// cot(rz);
		float newz=rz;
		int dir=1;
		if(z<=currz){dir=-1;   }
		for(;;){
			// mtxlock(0);
			first_mtx.lock();
			if(pressuref>2){
				pov->cancel=1;
			}
			// cot(dir);
			// cot(newz);
			if(pov->cancel){first_mtx.unlock();break;}
			if(pov->pause){
				first_mtx.unlock();
				while(pov->pause)sleepms(200);
				first_mtx.lock();
			}
			if(dir==1 && newz<=0){first_mtx.unlock();break;}
			if(dir==-1 && newz>=0){first_mtx.unlock();break;}
			if(dir==1)newz-=speed;else newz+=speed;
			osg::Matrix Trf;
			Trf.makeTranslate( 0,0,speed*dir );	
			lop(i,0,ve.size()){	
				ve[i]->transform->setMatrix(ve[i]->transform->getMatrix() *  Trf );	
				lop(j,0,ve[i]->points[0].size())ve[i]->points[0][j] = ve[i]->points[0][j]  * Trf  ; 
				ve[i]->drw->dirty();
				ve[i]->drw->set(GL_LINES,0, ve[i]->points->size());
				ve[i]->geometry ->setPrimitiveSet(0,ve[i]->drw); 
			}
			// if((*ve[0]->axisbegin).z()>=0 && rotate_pos!=0){
				// ve[0]->rotatetoposition(ve[0]->angle+90,pov);
				// rotate_pos=1;
			// }
			dbg_pos();
			// first_mtx.unlock();
			first_mtx.unlock();
			sleepms(5);
				// cot("PC");
		}
				
		posa_counter_mtx.lock();
		// cot(pov->posa_counter);
		pov->posa_counter--;
		posa_counter_mtx.unlock();
		// dbg_pos();
		
	},z,pov);
	th.detach();
}
void geraeixos(Group* group){ 
	
	// vec3* offset=new vec3(0,0,0);
	//robot offset
	int off_bucket=130; //off_bottom_from_250bucket
	vec3* offset=new vec3(610-110,272+off_bucket,-300);
	
	
	carril=new osgdr(group);
	carril->nodesstr.push_back("stl/robot_nema23.stl"); 
	carril->offset=offset;
	carril->newdr(vec3(110,250,-20),vec3(110,250,200));
	
	
	int idx;
	idx=0;
	ve.resize(idx+1);
	ve[idx]=new osgdr(group); 
	ve[idx]->nodesstr.push_back("stl/robot morango_corpo.stl");
	ve[idx]->nodesstr.push_back("stl/robot morango_balde.stl");
	ve[idx]->nodesstr.push_back("stl/robot morango_servospt70.stl"); 
	ve[idx]->axis=vec3(0,1,0);
	ve[idx]->anglemax=230;
	ve[idx]->anglemin=-90;
	ve[idx]->offset=offset;
	ve[idx]->newdr(vec3(110,250-off_bucket,-20),vec3(110,250-off_bucket,200));
		
	idx=1;
	ve.resize(idx+1);
	ve[idx]=new osgdr(group); 
	ve[idx]->nodesstr.push_back("stl/robot morango_servospt70_1.stl");
	ve[idx]->nodesstr.push_back("stl/robot morango_armj1.stl");
	ve[idx]->axis=vec3(1,0,0);
	ve[idx]->anglemin=-20;
	ve[idx]->anglemax=200;
	// ve[idx]->rotatedir=-1;
	ve[idx]->offset=offset;
	ve[idx]->newdr(vec3(0,127.18,-42.0),vec3(0,127.18+50,-42.0));
		
	// idx=2;
	// ve.resize(idx+1);
	// ve[idx]=new osgdr(group); 
	// ve[idx]->nodesstr.push_back("stl/robot morango_armj1_1.stl"); 
	// ve[idx]->axis=vec3(0,0,1); 
	// ve[idx]->anglemax=160;
	// ve[idx]->anglemin=-160;
	// ve[idx]->offset=offset;
	// ve[idx]->newdr(vec3(-55,228,0),vec3(-50,228,0));
	
	idx=2;
	ve.resize(idx+1);
	ve[idx]=new osgdr(group); 
	ve[idx]->nodesstr.push_back("stl/robot morango_armj2.stl"); 
	ve[idx]->nodesstr.push_back("stl/robot morango_servospt70_2.stl"); 
	ve[idx]->axis=vec3(0,1,0); 
	ve[idx]->anglemin=0;
	ve[idx]->anglemax=90;
	ve[idx]->offset=offset;
	ve[idx]->newdr(vec3(-66.61,271-off_bucket,-42.19),vec3(-150,271-off_bucket,-42.19));
	
	idx=3;
	ve.resize(idx+1);
	ve[idx]=new osgdr(group); 
	ve[idx]->nodesstr.push_back("stl/robot morango_armj3.stl"); 
	ve[idx]->axis=vec3(0,1,0);
	ve[idx]->anglemin=0;
	ve[idx]->anglemax=160;
	ve[idx]->offset=offset;
	ve[idx]->newdr(vec3(-325.77,281,-42.19),vec3(-400,281,-42.19));
	
	idx=4;
	ve.resize(idx+1);
	ve[idx]=new osgdr(group); 
	ve[idx]->nodesstr.push_back("stl/robot morango_armj4.stl"); 
	ve[idx]->axis=vec3(1,0,0);
	ve[idx]->anglemin=0;
	ve[idx]->anglemax=170;
	ve[idx]->offset=offset;
	ve[idx]->newdr(vec3(-459.61,127,-42.19),vec3(-600,127,-42.19));
 
	goffset(offset);
	
 
}
osg::ref_ptr<osg::Node> maquete;
osg::ref_ptr<osg::Node> ucs_icon;
vector<osg::ref_ptr<osg::Node>> cube10(8);
bool toggletranspbool=0;
void toggletransp(){
	toggletranspbool=!toggletranspbool;
	lop(i,0,ve.size()){
		lop(j,0,ve[i]->nodes.size()){
			settranparency(ve[i]->nodes[j],toggletranspbool);
		}
	}

} 

void bound_box(){
	//https://stackoverflow.com/questions/36830660/how-to-get-aabb-bounding-box-from-matrixtransform-node-in-openscenegraph https://groups.google.com/g/osgworks-users/c/K4px3UQXOew https://gamedev.stackexchange.com/questions/60505/how-to-check-for-cube-collisions
	// osg::ComputeBoundsVisitor* cbv=new osg::ComputeBoundsVisitor;
	// ve[0]->transform->accept(*cbv); 
	
	osg::ComputeBoundsVisitor cbv;
	ve[0]->transform->accept(cbv);
	osg::BoundingBox bb = cbv.getBoundingBox(); // in local coords.
	
	osg::ComputeBoundsVisitor cbv3;
	ve[3]->transform->accept(cbv3);
	osg::BoundingBox bb3 = cbv3.getBoundingBox(); // in local coords.
	
	// osg::BoundingBox bb = ve[0]->cbv->getBoundingBox();
	// osg::BoundingBox bb3 = ve[3]->cbv->getBoundingBox();
	 
// osg::Matrix localToWorld = osg::computeLocalToWorld( ve[0]->transform->getParentalNodePaths().front());// node->getParent(0)->getParentalNodePaths()[0] );
// osg::Matrix localToWorld = osg::computeLocalToWorld( ve[0]-> nodes[0]->getParent(0)->getParentalNodePaths()[0] );
 // for ( unsigned int i=0; i<8; ++i ) bb.expandBy( bb.corner(i) * localToWorld );
 
// osg::Matrix localToWorld3 = osg::computeLocalToWorld( ve[3]->transform->getParentalNodePaths().front());// node->getParent(0)->getParentalNodePaths()[0] );
// osg::Matrix localToWorld3 = osg::computeLocalToWorld( ve[3]->nodes[0]->getParent(0)->getParentalNodePaths()[0] );
 // for ( unsigned int i=0; i<8; ++i ) bb3.expandBy( bb3.corner(i) * localToWorld );
 
 
	bool intersects=bb.intersects(bb3);
	cot(intersects);
}


void loadstl(Group* group){
	
    maquete = osgDB::readRefNodeFile("stl/maquete.stl");
	settranparency(maquete.get(),1);
	group->addChild(maquete.get());
	
	
    ucs_icon = osgDB::readRefNodeFile("stl/3DUCSICON2.stl");
	settranparency(ucs_icon.get(),1);
	group->addChild(ucs_icon.get());
	
	// int plat_x=8, plat_y=4, plat_z=37, plat_zblock=4;
	int plat_x=4, plat_y=1, plat_z=2, plat_zblock=4;
	vector<vec3*> bdcpos(8);
	lop(i,0,cube10.size()){
		cube10[i] = osgDB::readRefNodeFile("stl/cube10.stl");
		settranparency(cube10[i].get(),1);
		MatrixTransform* trfm=new MatrixTransform;
		group->addChild(trfm);
		trfm->addChild(cube10[i].get());
		int x=i%4;
		int z=0;
		if(i>3)z=1;
		bdcpos[i]=new vec3(150+300*x,150,-150+-300*z);
		cot(*bdcpos[i]);
		osg::Matrix Trf;
		Trf.makeTranslate( bdcpos[i]->x(),bdcpos[i]->y(),bdcpos[i]->z() );
		trfm->setMatrix(trfm->getMatrix() *  Trf );	
	}

    // osg::ref_ptr<osg::Node> estrutura = osgDB::readRefNodeFile("Assembly1.stl");
	// settranparency(estrutura.get(),1);
	// group->addChild(estrutura.get());
	
};

int funcid=0;
//topoint faz override ao p
//vai ao posapool p=angles
//1000 é = ao anterior no p e  no z, x=0 e y=0 é =
// o topoint faz override ao p e lock_angle only works with posik
// posa({},{},0,0,0,0,0,{});
void posa(vfloat p, vec3 topoint=vec3(0,0,0), float x=0, float y=0, float z=1000,int speedtype=0,int funcn=0, vbool lock_angle={}){
	// int sz=p.size();
	// posapool.push_back(p);
	// cot("P");
	// std::thread th([=](float z ){
	// posa_counter_mtx.lock();
	cot1(funcn)
	// cot1(z);
	posa_erase_mtx.lock();
	pool.push_back( new posv{p,topoint,0,0,z,0,0,funcn,lock_angle});
	posa_erase_mtx.unlock(); 
	// posa_counter_mtx.unlock();
	// },z);
	// th.detach( );
	// posa_erase_mtx.unlock();
	// cot(posapool.size());
	// if(posapool.size()>1)return ;
	cot1(pool.size());
	// cot(posa_counter);
	if(pool.size()>1)return ;
	std::thread thm([](float z ){
		while(pool.size()!=0){ 
			posa_mtx.lock();  
			posa_erase_mtx.lock();
			posv* pov=pool[0];
			posa_erase_mtx.unlock();
			if(pressuref>2){
				pov->cancel=1;
			}
			if(pov->cancel){ 
				posa_erase_mtx.lock();
				delete pov;
				pool.erase(pool.begin()); 
				posa_erase_mtx.unlock();
				posa_mtx.unlock();
				continue;
			}
	
			// posv* pov=new posv;
			// pov->p=pool[0].p;
			// pov->topoint=pool[0].topoint;
			// pov->x=pool[0].x;
			// pov->y=pool[0].y;
			// pov->z=pool[0].z;
			vector<vec3> linearpov;
			vector<posv> linposv;
			z=pov->z;
			cot1(z);
			cout<<"MOVE START"<<endl;
			cout<<"FUNCID "<<pov->funcn<<endl;
			//here can be more complete with all axes topoint 0, we assume robot arm never goes 0,0,0
			if(pov->topoint.x()!=0){ 
				cout<<"FROM POINT "<<*ve[4]->axisend<<endl;
				cout<<"TO POINT "<<pov->topoint<<endl;
				// cot(pov->topoint);
				// linearpov=segments_3d(*ve[3]->axisend  , pov->topoint);
				// linposv=vector<posv>(linearpov.size());
				// lop(i,0,linearpov.size())cot(linearpov[i])
				// lop(i,0,linearpov.size()){
					// posv pv=ve[3]->posik(linearpov[i]);
					// cot(pv.p);
					// cot(pv.z);
					// linposv[i]=pv;
				// }
				posv pv=ve[4]->posik(pov->topoint,pov->lock_angle);
				pov->p=pv.p;
				z=pv.z;
				
				// sz=pov->p.size();
			}
			
			posa_counter_mtx.lock();
			pov->posa_counter=pov->p.size(); 
			posa_counter_mtx.unlock();
			// cot(pov->posa_counter);
			// cot(*ve[3]->axisend); //aparece valor anterior ao movimento 
			// cot(pov->p);
			
			
			
				lop(i,0,pov->p.size()){ 
					float newangle= pov->p[i];
					if(newangle>=999){posa_counter_mtx.lock();pov->posa_counter--;posa_counter_mtx.unlock(); continue;}
					ve[i]->rotatetoposition(newangle,pov); 
		// cot(pool.size()); 
				}	
				
				if(z<1000){
					// cout<<"MOVZ "<<z<<endl;
				// cot(pov->posa_counter);
					pov->posa_counter+=1;
					movetoposz(z,pov);
				// cot(z);
				}
			while(pov->posa_counter>0){
				cot(pool.size());
				cot(pov->p);
				cot1(pov->posa_counter);
				sleepms(1000);
			} 
			// cot(*ve[3]->axisend);
			// delete pov;
			posa_erase_mtx.lock();
			delete pov;
			pool.erase(pool.begin());
			// delete pov;
			posa_erase_mtx.unlock();
			posa_mtx.unlock();
			// cot("unlock"); 
		}
	},z);
	thm.detach( );
}
void posi(int index,float angle){
	vfloat angles(ve.size());
	posa_erase_mtx.lock();
	// cot(pool.back().p);
	lop(i,0,ve.size())angles[i]=ve[i]->angle;
	// for(int j=pool.size()-1;j>=0;j--)
		// if(pool[j].p.size()>0){
			// lop(i,0,pool[j].p.size())angles[i]=pool[j].p[i]; 
			// break;
		// }	
	for(int j=pool.size()-1;j>=0;j--)
		if(pool[j]->p.size()>0){
			lop(i,0,pool[j]->p.size())angles[i]=pool[j]->p[i]; 
			break;
		}
	posa_erase_mtx.unlock();
	angles[index]=angle;
	// cout<<"ii"<<index<<endl;
	// cot(index);
	// cot(posapool.size());
	// cot(angles);
	posa(angles);
	
}

void posik(vec3 vv, vbool lock_angle){
	// copy_points_k();
	// dbg_force=1;
	// dbg_pos();
	// cot("copied ik");
	// pos_k(vfloat{0,20,20,70});
	
	// vfloat angles=ve[3]->posik(vv);
	// posa(angles);
	// posa({},vv);
	posa({},vv,0,0,0,0,0,lock_angle);
	return;
	// lop(i,0,ve.size()){
		// ve[i]->rotate_posk(angles[i]);
		// ve[i]->rotatetoposition(angles[i]);
	// }
	// cot(angles);
}

void movz(float z){
	posa({},{},0,0,z);
}
//Rotas
#if 1

void reset(){
	movz(150);
	posa({-90 , 140 , 80 , 120} );
}


void loop(){
	
	
	
}
#endif

//Fann
#if 1
// #include "comb.hpp"
#include "fann.h"
#define mathNumscale(num,factorx,min,max,midletarget)({float _mnsfd = (factorx)/2.0-(midletarget); float _mnsfactor = (float)(factorx) / ((max) - (min));( ((num) - (min)) * _mnsfactor - _mnsfd);})
#define mathNumdescale(num,factorx,min,max,midletarget)({float _mndsfd = (factorx)/2.0-(midletarget); float _mndsfactor = (float)(factorx) / ((max) - (min));( ((num) + _mndsfd) / _mndsfactor + (min) );})
// float scale(float min,float max
void fann_init(){
	int sz=ve.size();
	
	float xmin=0;
	float xmax=600;
	float ymin=120 , ymax=150;
	float zmin=-600 , zmax=0;
	
	const unsigned int num_input = 3;
    const unsigned int num_output = sz;
    const unsigned int num_layers = 3;
    const unsigned int num_neurons_hidden = 3;
	
	float factorx=2;
	float midletarget=0;
	
	vint r( sz );
	
	lop(i,0,sz){
		float ms=mathNumscale(1,factorx,ve[i]->anglemin,ve[i]->anglemax,midletarget);
		cot(ms);
		float msn=mathNumdescale(ms,factorx,ve[i]->anglemin,ve[i]->anglemax,midletarget);
		cot(msn);
		r[i]= ( ve[i]->anglemax - ve[i]->anglemin ) /10 +1;
		
		cot(r[i]);
	} 
	combR cb(r);
	cot(cb.range);
	vint cbres;
	
	cot(cb.toComb(0));
	cot(cb.toComb(cb.range-1));
	// return;
	
	stringstream strm;
	stringstream strmnscale;
	int count=0;
	vec3* axis=ve[3]->axisend;
	posa_debug=0;
	lop(i,0,cb.range){
		cbres=cb.toComb(i);
		// cot(cbres);
		lop(j,0,cb.k){
			cbres[j]*=10;
			cbres[j]+=ve[j]->anglemin;
			ve[j]->rotate_posk(cbres[j]);
		}
		// cot(cbres);
		// cot(*axis);
		if(axis->x()<xmin)continue;
		if(axis->x()>xmax)continue;
		if(axis->y()<ymin)continue;
		if(axis->y()>ymax)continue;
		if(axis->z()<zmin)continue;
		if(axis->z()>zmax)continue;
		strmnscale<<axis->x()<<" "<<axis->y()<<" "<<axis->z()<<endl;;
		float msx=mathNumscale( axis->x() ,factorx ,xmin,xmax,midletarget);
		strm<<msx<<" ";
		float msy=mathNumscale( axis->y() ,factorx,ymin,ymax,midletarget);
		strm<<msy<<" ";
		float msz=mathNumscale( axis->z() ,factorx,zmin,zmax,midletarget);
		strm<<msz<<endl;
		
		lop(j,0,sz){
			float ms=mathNumscale( cbres[j] ,factorx,ve[j]->anglemin,ve[j]->anglemax,midletarget);
			strm<<ms<<" ";
			strmnscale<<cbres[j]<<" ";
			// cot(ms);
		}
		count++;
		strm<<endl;
		strmnscale<<endl;
		// pausa
	}
	stringstream str;
	str<<count<<" "<<num_input<<" "<<num_output<<endl<<strm.str();
	ofstream ostrm("fann.txt");
	ostrm<<str.str();
	ofstream ostrmns("fann_noscale.txt");
	ostrmns<<strmnscale.str();
}
void train(){	
	int sz=ve.size();
	// float xmin=0;
	// float xmax=1200;
	// float ymin=120 , ymax=670;
	// float zmin=-600 , zmax=670;
	const unsigned int num_input = 3;
    const unsigned int num_output = sz;
    const unsigned int num_layers = 3;
    const unsigned int num_neurons_hidden = 10;
	const float desired_error = (const float) 0.009;
    const unsigned int max_epochs = 500000;
    const unsigned int epochs_between_reports = 100;
	// struct fann *ann = fann_create_standard(num_layers, num_input,num_neurons_hidden, num_output);
	struct fann *ann = fann_create_from_file("fann.net");

    fann_set_activation_function_hidden(ann, FANN_SIGMOID_SYMMETRIC);
    fann_set_activation_function_output(ann, FANN_SIGMOID_SYMMETRIC);

	// fann_set_training_algorithm(ann, FANN_TRAIN_BATCH);
	
    fann_train_on_file(ann, "fann.txt", max_epochs,
        epochs_between_reports, desired_error);

    fann_save(ann, "fann.net");

    fann_destroy(ann);
	
	
}
void fann_calc(){
	fann_type *calc_out;
    fann_type input[3];
	struct fann *ann = fann_create_from_file("fann.net");
	input[0] = 0.0337729;
    input[1] = -0.212766;
    input[2] = -0.469913;
    calc_out = fann_run(ann, input);
	
	printf("xor test (%f,%f) -> %f\n", input[0], input[1], calc_out[3]);

    fann_destroy(ann);
}

#endif

//Lua
#if 1
// https://www.lua.org/manual/5.2/pt/manual.html
#ifdef WIN32 
#include <lua.hpp>
	#else
#include <lua5.3/lua.hpp> 
#endif
lua_State* lua_init();
void lua_str(string str);
int ltable(lua_State* L){ 
	int t = lua_type(L, 1); 
	if(t == LUA_TTABLE) {
        int len = lua_rawlen(L, 1); 
		lua_pushvalue(L, 1);
		lua_pushnil (L);
		while (lua_next (L, -2) != 0) { 
			cot( lua_tonumber(L,-1) ); 
			lua_pop (L, 1);
		}
 
	}  
	cot( lua_tonumber(L,2) ); 
	return 1;
}
int add(lua_State* L){ 
	float n1=lua_tonumber(L,1);
	float n2=lua_tonumber(L,2);
	lua_pushnumber(L,n1+n2);
	return 1;
}
//not working
int pressure(lua_State* L){  
	lua_pushnumber(L,pressuref);
	// cot1(pressuref);
	return 1;
}
int movz(lua_State* L){
	float n1=lua_tonumber(L,1);
	cot1(n1);
	// movetoposz( n1 );;
	posa({},{},0,0,n1);
	return 1;
}
int posadebug(lua_State* L){
	posa_debug=lua_tonumber(L,1); 
	return 1;
}
int cancel_all(lua_State* L){ 
	lop(i,0,pool.size()){
		pool[i]->cancel=1;
	}
	return 1;
}
int posa(lua_State* L){
	// cot(lua_gettop(L));
	int sz=lua_gettop(L); 
	vfloat p(sz);
	lop(i,0,sz){  
		if(lua_tostring (L,i+1)==NULL)
			p[i]=1000;
		else
			p[i]=lua_tonumber(L,i+1 );
	}
	// posa(p );
	posa(p,{},0,0,1000,0,funcid);
	return 1;
}
int posi(lua_State* L){
	// cot(lua_gettop(L));
	int sz=lua_gettop(L); 
	vfloat p(sz);
	lop(i,0,sz)p[i]=lua_tonumber(L,i+1);

	posi(p[0],p[1]);
	return 1;
}
int pik2(lua_State* L){
	// cot(lua_gettop(L));
	int sz=lua_gettop(L); 
	vfloat p(sz);
	lop(i,0,sz)p[i]=lua_tonumber(L,i+1);

	// pik2(vec3(p[0],p[1],p[2]));
	
	
	return 1;
}
int posaik(lua_State* L){
	// cot(lua_gettop(L));
	int sz=lua_gettop(L); 
	vfloat p(3);
	// lop(i,0,3)cot1(lua_tonumber(L,i+1));
	lop(i,0,3)p[i]=lua_tonumber(L,i+1);
	vbool lock_angle(ve.size());
	lop(i,3,sz)lock_angle[i-3]=lua_tonumber(L,i+1);
	
// cot1(lock_angle);pausa
	posik(vec3(p[0],p[1],p[2]),lock_angle);
	
	
	return 1;
} 
mutex luam;
void luaL_loadstring_arg( string str,vstring args){
	// luam.lock();
	lua_State* L=lua_init();
	// cot1(str)
	//cot(args[0]);
	
	if(args.size()>0){
		lua_pushnumber(L,atof(args[0].c_str()));	// lua_pushstring(L, "nick");
		lua_setglobal(L, "z");  
	}
	if(args.size()>1){
		lua_pushstring(L,args[1].c_str());
		lua_setglobal(L, "js");  
	} 
	ifstream input( "frobot.lua" );
	stringstream str1;
	str1<<input.rdbuf();
	str=str1.str()+"\n"+str+"\n::exit::";  
	luaL_loadstring(L, str.c_str());  
	if (lua_pcall(L,0,0,0)!=LUA_OK) fprintf(stderr,"%s\n", lua_tostring(L,-1) );
	// luam.unlock();
}
mutex funclock;
int func(lua_State* L){ 
	int id=lua_tonumber(L,1);
	funclock.lock();
	funcid=id;
	funclock.unlock();
	cotm(funcid)
	// pausa
	sqlite3_stmt* st;
    sqlite3_prepare_v2(sql3, rprintf("select run from tabRobot where id='%d'",id),-1, &st, NULL);
	cot(id);
	while(sqlite3_step(st)== SQLITE_ROW){ 
	cot(sqlite3_column_text(st,0));
		// lua_State* L=lua_init();
		int sz=lua_gettop(L)-1; 
		// cot1(sz);
		vstring p(sz);
		lop(i,0,sz){  
			p[i]=lua_tostring (L,i+1+1);
			cot1(p[i]);
		}
		// string f=lua_tostring (L,1+1);
		// cot(f);
		// cot((const char*)sqlite3_column_text(st,0));
		luaL_loadstring_arg((const char*)sqlite3_column_text(st,0) , p);
		// lua_State* L=lua_init();
		// luaL_loadstring(L, (const char*)sqlite3_column_text(st,0) );
		// lua_pcall(L, 0, 0, 0);		
	} 
	sqlite3_finalize(st); 	
	return 1;
}
int view(lua_State* L){
	cot(88);
	// cot(lua_gettop(L));
	int sz=lua_gettop(L);
	if(sz<9)return 1;
	
	vfloat vf(sz);
	lop(i,0,sz){ ;
		vf[i]= lua_tonumber(L,i+1);   
	}
	Vec3d eye( vf[0] , vf[1] , vf[2]  );
	Vec3d center( vf[3] , vf[4] , vf[5]  );
	Vec3d up( vf[6] , vf[7] , vf[8]  ); 
	cot(center);
	tmr->setAutoComputeHomePosition(true);
	tmr->setHomePosition( eye, center, up );
	// tm->home(0.0);
	// tm->setPivot(Vec3f(0,0,0));
	osggl->setCameraManipulator(tmr);
	
	return 1;
}
lua_State* lua_init(){	
	lua_State* L=luaL_newstate();
	luaL_openlibs(L); 
	
	lua_pushcfunction(L,  add );
	lua_setglobal(L,"add");
	
	lua_pushcfunction(L,  pressure );
	lua_setglobal(L,"pressure");
	
	lua_pushcfunction(L,  movz );
	lua_setglobal(L,"movz");
	
	lua_pushcfunction(L,  func );
	lua_setglobal(L,"func");
	
	lua_pushcfunction(L,  posa );
	lua_setglobal(L,"posa");
	
	lua_pushcfunction(L,  posi );
	lua_setglobal(L,"posi");
	
	lua_pushcfunction(L,  pik2 );
	lua_setglobal(L,"pik2");
	
	lua_pushcfunction(L,  posaik );
	lua_setglobal(L,"posaik");
	
	lua_pushcfunction(L,  view );
	lua_setglobal(L,"view");
	
	lua_pushcfunction(L,  cancel_all );
	lua_setglobal(L,"cancel_all");
	
	lua_pushcfunction(L,  posadebug );
	lua_setglobal(L,"posadebug");
	
	lua_pushcfunction(L,  ltable );
	lua_setglobal(L,"ltable");
	
	return L;
}
void lua_str(string str){	
	ifstream input( "frobot.lua" );
	stringstream str1;
	str1<<input.rdbuf();
	str=str1.str()+"\n"+str+"\n::exit::"; 
	lua_State* L=lua_init();
	luaL_loadstring(L, str.c_str());
	// lua_pcall(L, 0, 0, 0);
	if (lua_pcall(L,0,0,0)!=LUA_OK) fprintf(stderr,"%s\n", lua_tostring(L,-1) );
	
	lua_close(L);
}
void lua(){
	
	lua_State* L=lua_init();
	
	cout<<"LUA FILE"<<endl;
	luaL_dofile(L, "frobot.lua");
	
	// lua_getglobal(L,"x");
	// cout<<lua_tonumber(L,-1)<<endl;
	// lua_getglobal(L,"xx");
	// cout<<lua_tonumber(L,-1)<<endl;
	
	lua_close(L);
	
	// lua_pushstring(L, "nick");
	
	// lua_pushstring(L, "nick");         // push a string on the stack
	// lua_setglobal(L, "name");          // set the string to the global 'name'
	
}
void fparse_str(string text, int linepos){ 
	vector<string> strs=split(text,"\n");
	// cot(strs.size());
	// cot(linepos);
	if(linepos<0)return;
	cot(strs[linepos]);
	lua_str(strs[linepos]);	
}
#endif

//VIEW
#if 1 
void getview(){
	#define mathRound(n,d) ({float _pow10=pow(10,d); floorf((n) * _pow10 + 0.5) / _pow10;})
	osg::Vec3 eye, center, up;
	osggl->getCamera()->getViewMatrixAsLookAt( eye, center, up );
	cot(eye);
	cot(center);
	cot(up); 
	cout<<"view1: "<<mathRound(eye.x(),1)<<" "<<mathRound(eye.y(),1)<<" "<<mathRound(eye.z(),1)<<" "<<mathRound(center.x(),1)<<" "<<mathRound(center.y(),1)<<" "<<mathRound(center.z(),1)<<" "<<mathRound(up.x(),1)<<" "<<mathRound(up.y(),1)<<" "<<mathRound(up.z(),1)<<" "<<endl;
	cout<<"view( "<<mathRound(eye.x(),1)<<" , "<<mathRound(eye.y(),1)<<" , "<<mathRound(eye.z(),1)<<" , "<<mathRound(center.x(),1)<<" , "<<mathRound(center.y(),1)<<" , "<<mathRound(center.z(),1)<<" , "<<mathRound(up.x(),1)<<" , "<<mathRound(up.y(),1)<<" , "<<mathRound(up.z(),1)<<" )"<<endl;
}

#endif

//FlEditor
#if 1
struct FlEditor:Fl_Text_Editor{
	Fl_Text_Buffer  *texto = 0;
	// string fname="frobot.txt";
	string fname="frobot.lua";
	//tipo=0 editor do lua
	//tipo=1 editor do sqlite
	int tipo=0;
	FlEditor(int x,int y,int w, int h) : Fl_Text_Editor(x,y,w, h) {
		Fl::set_fonts();	
		texto = new Fl_Text_Buffer;
		texto->tab_distance(2);
		buffer(texto);
		//textfont(FL_HELVETICA);
		wrap_mode(Fl_Text_Editor::WRAP_AT_PIXEL, 0);
		linenumber_width(17);
		linenumber_size(9);
		textsize(12);
		// if(tipo==0)load(); 
	}
	int handle(int e){ 
		int ret=Fl_Text_Editor::handle(e); 
		// if(e==FL_KEYDOWN &&  Fl::event_state() ==FL_CTRL && Fl::event_key()==102) find_cb();
		if(e==FL_KEYDOWN){
			if(tipo==0)save();
			//altgr .
			if(Fl::event_alt ())cot("if(Fl::event_alt ()");
			if(Fl::event_shift ())cot("if(Fl::event_shift ()");
			// if(Fl::event_alt () && Fl::event_key()==46){
			if(Fl::event_alt () && Fl::event_key()==120){
			// if(!Fl::event_shift()  && (Fl::event_key()==65027 || Fl::event_key()==65514)){//altgr
				cot1("0");
				// cot1(Fl::event_key());
				int new_pos = insert_position();
				int line = texto->count_lines(0, new_pos);
				// int ls = texto->line_start(new_pos);
				// cot(line);
				// cot(ls);
				fparse_str(texto->text(),line);
				kf_down(0,this);
			}
			//altgr ,
			// if(Fl::event_alt () && Fl::event_key()==44){  
			if(Fl::event_alt () && Fl::event_key()==122){  
			// if(Fl::event_shift()  && (Fl::event_key()==65027 || Fl::event_key()==65514) ){
				// run all text
				lua_str(texto->text());
			}
			cot(Fl::event_key());
		}
		if(e==FL_PUSH ){
			// cot(texto->selection_text()); 
		}
		return ret;
	}
	void load(){
		string line;
		stringstream lines;
		ifstream myfile (fname);
		if (myfile.is_open()){
			while ( getline (myfile,line) ){
				lines<< line << '\n';
			}
			myfile.close();
			string t=lines.str();
			replace_All(t, "\r", "");
			// boost::replace_all(t, "\r", "");
			texto->text(t.c_str());
		}
		else cout << "Unable to open file "<<fname<<endl; 
	}
	void save(){
		string t=texto->text();
		replace_All(t, "\r", "");
		// boost::replace_all(t, "\r", ""); 
		ofstream o(fname);
		o<<t;
	}


};

FlEditor* fle;
#endif

int Break=0;
bool makvisible=1;
bool robotvisible=1;
//OPENCV
#if 1
#include "Fl_ViewerCV.h"
#include <opencv2/dnn.hpp>
#include <opencv2/imgproc.hpp>
#include <opencv2/highgui.hpp>

// Namespaces.
using namespace cv;
using namespace std;
using namespace cv::dnn;
Fl_ViewerCV* flcv=0;
 
struct flocvs{
	cv::VideoCapture cap;
	cv::Mat dst;
	cv::Mat frame;
	flocvs(){ 
		if(!cap.open(0))// open the default camera, use something different from 0 otherwise; Check VideoCapture documentation.
			return ; 
		// cap.set(CV_CAP_PROP_FRAME_WIDTH , 352);
		// cap.set(CV_CAP_PROP_FRAME_HEIGHT , 288);
		// dst=new cv::Mat;
		// dst= cv::Mat;
		Fl::add_timeout(1.0/4, Timer_CB, (void*)this);
	}
	void draw(){ 
		if(Break)return;
		cap >> frame;
		// frame = imread("3093.png");
		if( frame.empty() ) return; 
		// cv::flip(frame, *dst, 1);
		cv::resize(frame, frame, cv::Size(320, 320));
		// cv::resize(frame, frame, cv::Size(320, 240));
		// cv::resize(frame, frame, cv::Size(800, 600));
		cv::flip(frame, frame, 1); 
		cout << "Width : " << frame.cols << endl;
		cout << "Height: " << frame.rows << endl;
		frame=process(frame);
		flcv->SetImage(&frame); 
		
 
	} 
	static void Timer_CB(void *userdata) { 
		// if(Break)return;
		flocv->draw();
        Fl::repeat_timeout(1.0/10, Timer_CB, userdata);
    } 
	void close(){
		cap.release();
	}
cv::Mat process(Mat &frame){ 
	 // Load class list.
    vector<string> class_list;
    ifstream ifs("coco.names");
    string line;

    while (getline(ifs, line))
    {
        class_list.push_back(line);
    }

    // Load image.
    // Mat frame;
    // frame = imread("sample.jpg");
    // frame = imread("3093.png");

    // Load model.
    Net net;
    // net = readNet("yolov5s.onnx"); 
    // net = readNet("yolov5m.onnx"); 
    // net = readNet("Fruits.pt"); 
    net = readNet("yolov5n.onnx"); 
    // net = readNet("Fruits.onnx"); 

    vector<Mat> detections;
    detections = pre_process(frame, net);

    Mat img = post_process(frame.clone() , detections, class_list);

    // Put efficiency information.
    // The function getPerfProfile returns the overall time for inference(t) and the timings for each of the layers(in layersTimes)

    vector<double> layersTimes;
    double freq = getTickFrequency() / 1000;
    double t = net.getPerfProfile(layersTimes) / freq;
    string label = format("Inference time : %.2f ms", t);
    putText(img, label, Point(20, 40), FONT_FACE, FONT_SCALE, RED);

    // imshow("Output", img);
    return img;
}

// Constants.
const float INPUT_WIDTH = 640.0;
const float INPUT_HEIGHT = 640.0;
const float SCORE_THRESHOLD = 0.5;
const float NMS_THRESHOLD = 0.45;
const float CONFIDENCE_THRESHOLD = 0.45;

// Text parameters.
const float FONT_SCALE = 0.7;
const int FONT_FACE = FONT_HERSHEY_SIMPLEX;
const int THICKNESS = 1;

// Colors.
Scalar BLACK = Scalar(0,0,0);
Scalar BLUE = Scalar(255, 178, 50);
Scalar YELLOW = Scalar(0, 255, 255);
Scalar RED = Scalar(0,0,255);


// Draw the predicted bounding box.
void draw_label(Mat& input_image, string label, int left, int top)
{
    // Display the label at the top of the bounding box.
    int baseLine;
    Size label_size = getTextSize(label, FONT_FACE, FONT_SCALE, THICKNESS, &baseLine);
    top = max(top, label_size.height);
    // Top left corner.
    Point tlc = Point(left, top);
    // Bottom right corner.
    Point brc = Point(left + label_size.width, top + label_size.height + baseLine);
    // Draw black rectangle.
    rectangle(input_image, tlc, brc, BLACK, FILLED);
    // Put the label on the black rectangle.
    putText(input_image, label, Point(left, top + label_size.height), FONT_FACE, FONT_SCALE, YELLOW, THICKNESS);
}


vector<Mat> pre_process(Mat &input_image, Net &net)
{
    // Convert to blob.
    Mat blob;
    blobFromImage(input_image, blob, 1./255., Size(INPUT_WIDTH, INPUT_HEIGHT), Scalar(), true, false);

    net.setInput(blob);

    // Forward propagate.
    vector<Mat> outputs;
    net.forward(outputs, net.getUnconnectedOutLayersNames());

    return outputs;
}


Mat post_process(Mat input_image, vector<Mat> &outputs, const vector<string> &class_name) 
{
    // Initialize vectors to hold respective outputs while unwrapping detections.
    vector<int> class_ids;
    vector<float> confidences;
    vector<Rect> boxes; 

    // Resizing factor.
    float x_factor = input_image.cols / INPUT_WIDTH;
    float y_factor = input_image.rows / INPUT_HEIGHT;

    float *data = (float *)outputs[0].data;

    const int dimensions = 85;
    const int rows = 25200;
    // Iterate through 25200 detections.
    for (int i = 0; i < rows; ++i) 
    {
        float confidence = data[4];
        // Discard bad detections and continue.
        if (confidence >= CONFIDENCE_THRESHOLD) 
        {
            float * classes_scores = data + 5;
            // Create a 1x85 Mat and store class scores of 80 classes.
            Mat scores(1, class_name.size(), CV_32FC1, classes_scores);
            // Perform minMaxLoc and acquire index of best class score.
            Point class_id;
            double max_class_score;
            minMaxLoc(scores, 0, &max_class_score, 0, &class_id);
            // Continue if the class score is above the threshold.
            if (max_class_score > SCORE_THRESHOLD) 
            {
                // Store class ID and confidence in the pre-defined respective vectors.

                confidences.push_back(confidence);
                class_ids.push_back(class_id.x);

                // Center.
                float cx = data[0];
                float cy = data[1];
                // Box dimension.
                float w = data[2];
                float h = data[3];
                // Bounding box coordinates.
                int left = int((cx - 0.5 * w) * x_factor);
                int top = int((cy - 0.5 * h) * y_factor);
                int width = int(w * x_factor);
                int height = int(h * y_factor);
                // Store good detections in the boxes vector.
                boxes.push_back(Rect(left, top, width, height));
            }

        }
        // Jump to the next column.
        data += 85;
    }

    // Perform Non Maximum Suppression and draw predictions.
    vector<int> indices;
	NMSBoxes(boxes, confidences, SCORE_THRESHOLD, NMS_THRESHOLD, indices);
    for (int i = 0; i < indices.size(); i++) 
    {
        int idx = indices[i];
        Rect box = boxes[idx];

        int left = box.x;
        int top = box.y;
        int width = box.width;
        int height = box.height;
        // Draw bounding box.
        rectangle(input_image, Point(left, top), Point(left + width, top + height), BLUE, 3*THICKNESS);

        // Get the label for the class name and its confidence.
        string label = format("%.2f", confidences[idx]);
        label = class_name[class_ids[idx]] + ":" + label;
        // Draw class labels.
        draw_label(input_image, label, left, top);
    }
    return input_image;
}
};
#endif

#if 1 //SQLITE3 && FLTK
 
struct Fl_Scroll_p:Fl_Scroll{ 
	vector<float> ch;
	vector<float> cw;
	vector<float> cx;
	vector<float> cy;
	Fl_Scroll_p(int X,int Y,int W, int H) : Fl_Scroll(X,Y,W,H) {  
	};
	void resize (int X, int Y, int W, int H){ 
		Fl_Widget::resize(X,Y,W,H);
 		int dx = X-x(), dy = Y-y();
		int dw = W-w(), dh = H-h();
		// fix_scrollbar_order(); 
		float wf=1.35;
		float hf=1.3; 
		//preserve initial values
		bool fillp=0;
		if(ch.size()==0){
			ch=vector<float>(children());
			cw=vector<float>(children());
			cx=vector<float>(children());
			cy=vector<float>(children());
			fillp=1;
		} 
		Fl_Widget*const* a = array();
		// for (int i=0;i<children();i++) {
		for (int i=children()-2; i--;) {
			Fl_Widget* o = *a++; 
			if(fillp){
				ch[i]=o->h();
				cw[i]=o->w();
				cx[i]=o->x();
				cy[i]=o->y();
			}
			// o->resize(o->x()+dx, o->y()+dy,o->w()*wf,o->h()*hf);
			o->resize(cx[i]+dx, cy[i]+dy,cw[i]*wf,ch[i]*hf); 
		} 
		Fl_Widget::resize(X,Y,W,H); // resize _before_ moving children around  
	}	
};


vector<Fl_Input*> flml_id;
vector<Fl_Input*> flml_time;
vector<Fl_Input*> flml_desc;
vector<FlEditor*> flml_run; 
Fl_Double_Window* flscrolldiv;  
Fl_Scroll* flscroll; 
sqlite3_stmt* st;
int idx=0;
void fill_input(int idx,bool newr=0);

void input_callback(Fl_Widget *, void* v){
	int vo=*((int*)&v);
	cot(vo);
	cot(flscroll->w());
	int id=atoi(flml_id[vo]->value());
	cot(id);
	cot(idx);
	if(idx==vo){//insert
        sqlite3_exec(sql3, rprintf("insert into tabRobot (time) values('%s')","") ,NULL,NULL,NULL);
		flml_id[vo]->value(to_string(sqlite3_last_insert_rowid(sql3)).c_str());
		idx++;
		int yp= (flscroll->yposition ());
		flscroll->scroll_to(0,120); //resolve bug do fltk
		fill_input(idx+0,1);
		flscroll->scroll_to(0,yp);
	}else{//update
	    auto t = std::time(nullptr);
		auto tm = *std::localtime(&t);
		stringstream tms;
		tms<<std::put_time(&tm, "%Y-%m-%d %H:%M:%S");
        sqlite3_exec(sql3, rprintf("update tabRobot set time='%s',desc='%s',run='%s', dateu='%s' where id='%s'",flml_time[vo]->value(),flml_desc[vo]->value(),flml_run[vo]->texto->text(),tms.str().c_str(),flml_id[vo]->value()   ) ,NULL,NULL,NULL);
	
		
	}
}
void fill_input(int idx,bool newr){	 
	int hh=18;
	int hh1=250;
	flml_id.push_back(new Fl_Input(0,idx*hh1,30,hh));
	flml_id.back()->type(FL_INPUT_READONLY);
	if(newr==0)flml_id.back()->value( (const char*)sqlite3_column_text(st,0) );
	flml_time.push_back(new Fl_Input(30,idx*hh1,40,hh));
	if(newr==0){
		string str_time=(const char*)sqlite3_column_text(st,1);	
		if(str_time.size()>5)str_time=str_time.substr(0, str_time.size()-3);
		flml_time.back()->value( str_time.c_str() );	
	}
	flml_time.back()->callback(input_callback,(void*)idx);
	flml_time.back()->textsize(12);;
	flml_desc.push_back(new Fl_Input(70,idx*hh1,150,hh));
	if(newr==0)flml_desc.back()->value( (const char*)sqlite3_column_text(st,2) );
	flml_desc.back()->callback(input_callback,(void*)idx);
	flml_run.push_back(new FlEditor(0,idx*hh1+hh,206,hh1-hh));
	flml_run.back()->tipo=1;
	if(newr==0)flml_run.back()->texto->text( (const char*)sqlite3_column_text(st,3) );
	flml_run.back()->callback(input_callback,(void*)idx);
	flml_run.back()->when(FL_WHEN_CHANGED);
	// flml_run.back()->resizable(flt);
	// flml_run.back()->resize(flml_run.back()->x(),flml_run.back()->y(),flscroll->w(),flml_run.back()->h());
	flscroll->add(flml_id.back());
	flscroll->add(flml_time.back());
	flscroll->add(flml_desc.back());
	flscroll->add(flml_run.back());
	flscroll->redraw(); 
	
}
 int sql_count(string sql){
	sql="SELECT count(*) from ("+sql+")";
    sqlite3_prepare_v2(sql3, sql.c_str(),-1, &st, NULL);
	int count=0;
	while(sqlite3_step(st)== SQLITE_ROW){ 
		count=atoi( (const char*)sqlite3_column_text(st,0) );
	}
	sqlite3_finalize(st);  
	return count;
}
Fl_Button* bt14; 
Fl_Input_Choice* search_in;
void choice_cb(Fl_Widget *w, void *userdata) {
	lop(i,0,flml_id.size()){
		Fl::delete_widget (flml_id[i]);
		Fl::delete_widget (flml_time[i]);
		Fl::delete_widget (flml_desc[i]);
		Fl::delete_widget (flml_run[i]);
	}
	flml_id.clear();
	flml_time.clear();
	flml_run.clear();
	flml_desc.clear();
	string txt=(search_in->input()->value());
	// int exit = 0;
    // exit = sqlite3_open("frobot.sqlite", &sql3);
	string sql="select * from tabRobot where desc like '%"+txt+"%' order by dateu desc";  
    sqlite3_prepare_v2(sql3, sql.c_str(),-1, &st, NULL);
	idx=0;
	while(sqlite3_step(st)== SQLITE_ROW){  
		fill_input(idx);
		idx++;
	}
	fill_input(idx,1); //new
	threadDetach([]{sleepms(50);cot(flscroll->yposition ());flscroll->scroll_to(0,0);flscroll->redraw(); flscroll->damage(1);}); 
	flscroll->scroll_to (0, 0);
	flscroll->redraw();
	sqlite3_finalize(st);
}
Fl_Input_Choice* search_numfunc;
void choice_cbnum(Fl_Widget *w, void *userdata) {
	lop(i,0,flml_id.size()){
		Fl::delete_widget (flml_id[i]);
		Fl::delete_widget (flml_time[i]);
		Fl::delete_widget (flml_desc[i]);
		Fl::delete_widget (flml_run[i]);
	}
	flml_id.clear();
	flml_time.clear();
	flml_run.clear();
	flml_desc.clear();
	string txt=(search_numfunc->input()->value());
	// int exit = 0;
    // exit = sqlite3_open("frobot.sqlite", &sql3);
	string sql="select * from tabRobot where id like '%"+txt+"%' order by dateu desc";  
    sqlite3_prepare_v2(sql3, sql.c_str(),-1, &st, NULL);
	idx=0;
	while(sqlite3_step(st)== SQLITE_ROW){  
		fill_input(idx);
		idx++;
	}
	fill_input(idx,1); //new
	threadDetach([]{sleepms(50);cot(flscroll->yposition ());flscroll->scroll_to(0,0);flscroll->redraw(); flscroll->damage(1);}); 
	flscroll->scroll_to (0, 0);
	flscroll->redraw();
	sqlite3_finalize(st);
}
// http://localhost/promition/phpliteadmin.php?database=..%2Frobot%5Crobot.sqlite
void sql3_init(){  
	Fl_Button* bt13=new Fl_Button(0,  90, 30, 30,"luaTx");
	bt14=new Fl_Button(30,  90, 30, 30,"bdAll");
	Fl_Button* bt15=new Fl_Button(60,  90, 30, 30,"bdRun");	
	bt13->down_color(FL_GREEN );
	bt14->down_color(FL_GREEN );
	bt15->down_color(FL_GREEN );
	bt13->type(FL_RADIO_BUTTON);
	bt14->type(FL_RADIO_BUTTON);
	bt15->type(FL_RADIO_BUTTON);
	bt13->callback([](Fl_Widget *, void* v){  
		fle->show();
		flscroll->hide();
	});
	bt14->callback([](Fl_Widget *, void* v){  
		fle->hide();
		flscroll->show(); 
	});	 		 
	
	// Fl_Button* in=new Fl_Button(0,120,100,30,"Test");
	search_in=new Fl_Input_Choice(30,120,130,30,"");
    search_in->callback(choice_cb, 0);
	// in->align(FL_ALIGN_LEFT);
    search_in->menubutton()->add("one");
    search_in->menubutton()->add("two");
    search_in->menubutton()->add("three");
    // in.menuvalue(0);
    // Fl_Button onoff(0,150,200,28,"Activate/Deactivate");
    // onoff.callback(buttcb, (void*)&in);
	
	
	search_numfunc=new Fl_Input_Choice(0,120,30,30,"");
    search_numfunc->callback(choice_cbnum, 0);
	
	// return;
	flscroll=new Fl_Scroll(0,150,160,480-150); 
	
    int exit = 0;
    exit = sqlite3_open("frobot.sqlite", &sql3);
	string sql="select * from tabRobot order by dateu desc"; 
	// resize_flscroll(sql);
    sqlite3_prepare_v2(sql3, sql.c_str(),-1, &st, NULL);
	idx=0;
	while(sqlite3_step(st)== SQLITE_ROW){ 
		fill_input(idx);
		idx++;
	}
	// 
	fill_input(idx,1); //new
	sqlite3_finalize(st);  
	
	// flscroll->resizable(flt);
	flscroll->end();  
	// lop(i,1,150)	fill_input(idx+i,1);
	// flml_run.back()->do_callback();
	// flml_id.back()->hide();
}
#endif

#if 1 //TIMER
Fl_Input* time_input;
Fl_Toggle_Button* time_input_btn;
mutex luac_ ;
void time_f(){	
	string time_input_str= (time_input->value());
	int hour=atoi( time_input_str.substr(0, 2).c_str() ); 
	int minute=atoi( time_input_str.substr(3, 2).c_str() );
	if(hour<10)minute=atoi( time_input_str.substr(2, 2).c_str() );
	// cot1(minute);
	sqlite3_stmt* st;
	string m="0"+to_string(minute); 
	if(m.size()>2)m=m.substr(1,2);
	string h=to_string(hour)+":"+ m;
	// cot1(rprintf("select run from tabRobot where time='%s'",h.c_str()));
    sqlite3_prepare_v2(sql3, rprintf("select id,run from tabRobot where time='%s'",h.c_str()),-1, &st, NULL); 
	while(sqlite3_step(st)== SQLITE_ROW){ 
	cot1(sqlite3_column_text(st,0));
		// cot((const char*)sqlite3_column_text(st,0) );
		
	luac_.lock();
		lua_State* L=lua_init();
		// luaL_loadstring(L, (const char*)sqlite3_column_text(st,1) );
		// lua_pcall(L, 0, 0, 0);	ifstream input( "frobot.lua" );
		ifstream input( "frobot.lua" );
		stringstream str1;
		str1<<input.rdbuf();
		string str=str1.str()+"\n"+(const char*)sqlite3_column_text(st,1)+"\n::exit::";  
		luaL_loadstring(L, str.c_str());
		if (lua_pcall(L,0,0,0)!=LUA_OK) fprintf(stderr,"%s\n", lua_tostring(L,-1) );
	luac_.unlock();
	} 
	sqlite3_finalize(st);
}

void interval(){ 
	time_input_btn->value(1);
	time_input_btn->down_color(FL_RED ); 
	time_input->value("0:00");
	threadDetach([]{
		for(;;){
			if(time_input_btn->value()==0){ //loop off
				time_t timer;
				time(&timer);
				struct tm* tms=localtime(&timer);
				time_input->value( (to_string(tms->tm_hour)+":"+(tms->tm_min<10?"0":"")+to_string(tms->tm_min)).c_str()); 
				time_f();
			}
			sleepms(1000);
		}	
	});
}
#endif


void test(){
	int servoMin = 500 ;
	int servoMax = 2500 ;
	cout<<pmap(160,0,320,servoMin, servoMax);
}

#if 1 //WMOVING
vbool wmoving(4);
osg::Vec3 fix_center_bug;
void wmove(){	
	// return;
   // cot(wmoving);
	osg::Vec3 eye, center, up;
	osggl->getCamera()->getViewMatrixAsLookAt( eye, center, up,50 ); 
	center=fix_center_bug;
	// tmr->setAutoComputeHomePosition(0);
	if(wmoving[0]){
		center.z()+=40; 
		eye.z()+=40; 
	}
	if(wmoving[1]){
		center.z()-=40; 
		eye.z()-=40; 
	}
	if(wmoving[2]){
		center.x()-=40; 
		eye.x()-=40; 
	}
	if(wmoving[3]){
		center.x()+=40; 
		eye.x()+=40; 
	}
	tmr->setHomePosition( eye, center, up );
	// tm->home(0.0);
	// tm->setPivot(Vec3f(0,0,0));
	osggl->setCameraManipulator(tmr);
	fix_center_bug=center;
}
int OnKeyPress(int Key, Fl_Window *MyWindow) { 
	if(Fl::focus()!=osggl)return Fl::handle_(Key, MyWindow);
	if(Key == FL_KEYDOWN) {
		// cot( Fl::event_key());
		int dkey=Fl::event_key();
		if(dkey==119)wmoving[0]=1;//w
		if(dkey==115)wmoving[1]=1;//s
		if(dkey==97)wmoving[2]=1;//a
		if(dkey==100)wmoving[3]=1;//d
		wmove();		 
      // cot( Fl::event_text());
		osggl->_gw->getEventQueue()->keyPress((osgGA::GUIEventAdapter::KeySymbol)Fl::event_key());
 
   }
   if(Key == FL_KEYUP) {
		int dkey=Fl::event_key();
		if(dkey==119)wmoving[0]=0;//w
		if(dkey==115)wmoving[1]=0;//s
		if(dkey==97)wmoving[2]=0;//a
		if(dkey==100)wmoving[3]=0;//d
		wmove();
		osggl->_gw->getEventQueue()->keyRelease((osgGA::GUIEventAdapter::KeySymbol)Fl::event_key());
      // cot( Fl::event_text());
 
   }
   return Fl::handle_(Key, MyWindow);
}
#endif

// #include <stdlib.h>
#if 1 //SSH
#include <libssh2.h>
#ifdef __linux__
#include <netinet/in.h>
#include <arpa/inet.h>
// #include <netdb.h>
#endif
struct sshconnect{
	LIBSSH2_SESSION *session;
	LIBSSH2_CHANNEL *channel; 
	int sock;
	int rc;
	string ip;
	string user;
	string pass;
	bool connected=0;
	void disconnect(){
		if(connected==0)return;
	    libssh2_session_disconnect(session, "Normal Shutdown, Thank you for playing");
		libssh2_session_free(session); 
		#ifdef WIN32
		closesocket(sock);
		#else
		close(sock);
		#endif
		fprintf(stderr, "all done\n");	 
		libssh2_exit();
		connected=0;
	}
	sshconnect(string _ip,string _user,string _pass){
		ip=_ip;
		user=_user;
		pass=_pass;
		cot1(connect_());
	}
	int connect_(){
		// disconnect();
		struct sockaddr_in sin;
		unsigned long hosti = inet_addr(ip.c_str());
		// struct hostent *host;  
		// if((host=gethostbyname(hostname.c_str()))==0){printf("errorhost");return;}
		// long hosti=*(long*)(host->h_addr);
#ifdef WIN32
    WSADATA wsadata;
    int err; 
    err = WSAStartup(MAKEWORD(2, 0), &wsadata);
    if(err != 0) {
        fprintf(stderr, "WSAStartup failed with error: %d\n", err);
        return 1;
    }
#endif
		rc = libssh2_init (0);
		if (rc != 0) {
			fprintf (stderr, "libssh2 initialization failed (%d)\n", rc);
			return 1;
		}
		sock = socket(AF_INET, SOCK_STREAM, 0);
		memset(&sin, 0, sizeof(sin));
		sin.sin_family = AF_INET;
		sin.sin_port = htons(22);
		sin.sin_addr.s_addr = hosti;
		if (connect(sock, (struct sockaddr*)(&sin), sizeof(sin)) != 0) {
			fprintf(stderr, "failed to connect!\n");
			return 1;
		}
		session = libssh2_session_init();
		if(!session){
			fprintf(stderr, "libssh2_session_init Failure establishing: %d\n", rc);
			return 1;
		}
		// libssh2_session_set_blocking(session, 1);
		lop(tries,0,5){
			rc = libssh2_session_handshake(session, sock);
		if(rc) {
			fprintf(stderr, "Failure establishing SSH session: %d\n", rc);
			if(tries>3)return 1;
			sleepms(200);
		}else break;
		}
		const char *fingerprint=fingerprint = libssh2_hostkey_hash(session, LIBSSH2_HOSTKEY_HASH_SHA1);
		fprintf(stderr, "Fingerprint: ");
		for(int i = 0; i < 20; i++) {
			fprintf(stderr, "%02X ", (unsigned char)fingerprint[i]);
		}
		fprintf(stderr, "\n");
		if (libssh2_userauth_password(session, user.c_str(), pass.c_str())) {
			fprintf(stderr, "Authentication by password failed.\n");
			disconnect();
			return 1;
		}
		connected=1;
		cot1("connected");		
		return 0;
		// if (libssh2_channel_request_pty(channel, "vanilla")) {
			// fprintf(stderr, "Failed requesting pty\n");
		// }
		// if (libssh2_channel_shell(channel)) {
			// fprintf(stderr, "Unable to request shell on allocated pty\n");
		// }
	}

 	static int waitsocket(int socket_fd, LIBSSH2_SESSION *session){
		struct timeval timeout;
		int rc;
		fd_set fd;
		fd_set *writefd = NULL;
		fd_set *readfd = NULL;
		int dir; 
		timeout.tv_sec = 10;
		timeout.tv_usec = 0; 
		FD_ZERO(&fd); 
		FD_SET(socket_fd, &fd); 
		/* now make sure we wait in the correct direction */ 
		dir = libssh2_session_block_directions(session); 
		if(dir & LIBSSH2_SESSION_BLOCK_INBOUND)
			readfd = &fd; 
		if(dir & LIBSSH2_SESSION_BLOCK_OUTBOUND)
			writefd = &fd; 
		rc = select(socket_fd + 1, readfd, writefd, NULL, &timeout); 
		return rc;
	}
	string exec(string cmd){
		if(connected==0)return "Error";
		/* Exec non-blocking on the remove host */ 
		while((channel = libssh2_channel_open_session(session)) == NULL &&
			libssh2_session_last_error(session, NULL, NULL, 0) ==LIBSSH2_ERROR_EAGAIN) {
			waitsocket(sock, session);
		}
		if(channel == NULL) {
			fprintf(stderr, "Error channel\n");
			return "Error";
		}
		int bytecount = 0;	
		// libssh2_session_set_blocking(session, 0);
		// while((rc = libssh2_channel_write(channel, cmd.c_str(),sizeof(cmd.c_str()))) == LIBSSH2_ERROR_EAGAIN) {
			// waitsocket(sock, session);
		// }
		// while((rc = libssh2_channel_send_eof(channel) == LIBSSH2_ERROR_EAGAIN)) {
			// waitsocket(sock, session);
		// }
		// libssh2_channel_write(channel, cmd.c_str(),strlen(cmd.c_str()));
		// libssh2_channel_send_eof(channel);
		
		while((rc = libssh2_channel_exec(channel, cmd.c_str())) == LIBSSH2_ERROR_EAGAIN) {
			waitsocket(sock, session);
		}
		// while((rc = libssh2_channel_send_eof(channel) == LIBSSH2_ERROR_EAGAIN)) {
			// waitsocket(sock, session);
		// }
		// return "";
		// rc = libssh2_channel_request_shell(channel);
		if(rc != 0) {
			fprintf(stderr, "Error libssh2_channel_exec\n");
			// exit(1);
		}
		string res;
		for( ;; ){
			/* loop until we block */
			int rc;
			do {
				char buffer[0x4000];
				rc = libssh2_channel_read( channel, buffer, sizeof(buffer) );
				if( rc > 0 )
				{
					int i;
					bytecount += rc;
					// fprintf(stderr, "We read:\n");
					for( i=0; i < rc; ++i ){
						res+=buffer[i];
						// fputc( buffer[i], stderr);
					}
					// fprintf(stderr, "\n");
				}
				else {
					// if( rc != LIBSSH2_ERROR_EAGAIN )
						/* no need to output this for the EAGAIN case */
						// fprintf(stderr, "libssh2_channel_read returned %d\n", rc);
				}
			}
			while( rc > 0 );
			/* this is due to blocking that would occur otherwise so we loop on
			   this condition */
			if( rc == LIBSSH2_ERROR_EAGAIN ) {
				waitsocket(sock, session);
			} else break;
		}
		// while((rc = libssh2_channel_send_eof(channel) == LIBSSH2_ERROR_EAGAIN)) {
			// waitsocket(sock, session);
		// }
		
		// int bytecount = 0;
		int exitcode = 127;		
		char *exitsignal=(char *)"none";
		while( (rc = libssh2_channel_close(channel)) == LIBSSH2_ERROR_EAGAIN )
			waitsocket(sock, session);
		if( rc == 0 ){
			exitcode = libssh2_channel_get_exit_status( channel );
			libssh2_channel_get_exit_signal(channel, &exitsignal,NULL, NULL, NULL, NULL, NULL);
		}
		// if (exitsignal)
			// fprintf(stderr, "\nGot signal: %s\n", exitsignal);
		// else
			// fprintf(stderr, "\nEXIT: %d bytecount: %d\n", exitcode, bytecount);
		libssh2_channel_free(channel);
		channel = NULL;
		return res;	
	}
};
void elevator_go(int floor){
	string res=ssh->exec(rprintf("cd desk/bwmission/makserver; echo '%d'>frobot_elevator.txt",floor));
	
}
void elevator(){
	thread th([](){
		// ssh->exec("cd desk/bwmission/robot");
		// sleepms(1000);
		string res;
		for(;;){
			res=ssh->exec("cd desk/bwmission/makserver; cat frobot_elevatorcurr.txt");
			if(res=="Error"){
				while(ssh->connect_())sleepms(2000);
			}
			cot1(res);
			sleepms(2000);
		}
	});
	th.detach();
	// ssh->exec("uptime");
	// ssh->disconnect();
}
#endif


#if 1 //GAMEPAD
#include <gamepad.h>
void Gamepad_Init(){
	GamepadInit();	 
  
	thread gm([](){
		static const char* button_names[] = {
			"d-pad up",
			"d-pad down",
			"d-pad left",
			"d-pad right",
			"start",
			"back",
			"left thumb",
			"right thumb",
			"left shoulder",
			"right shoulder",
			"???",
			"???",
			"A",
			"B",
			"X",
			"Y"
		};
		for(;;){
			GamepadUpdate();		 
			int i,j,k;
			for (i = 0; i != GAMEPAD_COUNT; ++i) {
				if (GamepadIsConnected((GAMEPAD_DEVICE)i)) {
					for (j = 0; j != BUTTON_COUNT; ++j) {
						if (GamepadButtonTriggered((GAMEPAD_DEVICE)i, (GAMEPAD_BUTTON)j)) {
							printf("[%d] button triggered: %d %s\n", i, j,button_names[j]);
							cot1(j);
			 				if(i==0){ 
								cot1(ve[0]->angle);
							}
							
						} else if (GamepadButtonReleased((GAMEPAD_DEVICE)i,(GAMEPAD_BUTTON) j)) {
							printf("[%d] button released: %d  %s\n", i,j, button_names[j]);
						}
					}
					for (j = 0; j != TRIGGER_COUNT; ++j) {
						if (GamepadTriggerTriggered((GAMEPAD_DEVICE)i, (GAMEPAD_TRIGGER)j)) {
							printf("[%d] trigger pressed:  %d\n", i, j);
						} else if (GamepadTriggerReleased((GAMEPAD_DEVICE)i, (GAMEPAD_TRIGGER)j)) {
							printf("[%d] trigger released: %d\n", i, j);
						}
					}
					for (j = 0; j != STICK_COUNT; ++j) {
						for (k = 0; k != STICKDIR_COUNT; ++k) {
							if (GamepadStickDirTriggered((GAMEPAD_DEVICE)i,(GAMEPAD_STICK) j, (GAMEPAD_STICKDIR)k)) {
								printf("[%d] stick direction:  %d -> %d\n", i, j, k);
							}
						}
					}
				}
			}
			sleepms(50);
		}
	});
	gm.detach();
}
#endif



int main(){
	combR *cr=new combR(vint{8,4,4});
	lop(i,0,cr->range){
		cot1(cr->toComb(i));
	}
	
	// Config cfg = Config::object();
// cfg["pi"]     = 3.14;
// cfg["array"]  = vint{ 1, 2, 3 };
// cfg["obj"] = Config::object({
	// { "key1", "value1" },
	// { "key2", 4 },
// });
// cot1(cfg["array"][1]);
// cot1(cfg["array"][1]);
	thread([](){
		ssh=new sshconnect("192.168.1.169","super","bdc");
		string res=ssh->exec(rprintf("cd desk/bwmission/makserver; ./makserver elevator %d",2));
		cot1(res);
		// elevator();
	}).detach();
	// pausa
	// string s = "example string";
    // string r = std::regex_replace(s, std::regex("xa"), "yr");  
	// cot1(r);
	string t="teste";
	replace_All(t, "te", "pa");
	cot1(t);
	string ms="ww";
	// sleepms(2000);
	vint pp={7,8,7};
	cot1(pp);
	// cot1(getenv("test"));
	  // char* pPath = getenv ("test");
	  // if(string(getenv("test"))=="ok")cot1("test");
    // printf (pPath);
	// test(); return 0;
// https://www.fltk.org/doc-1.3/opengl.html#opengl_drawing
// https://osg-users.openscenegraph.narkive.com/HiVHDrXM/change-camera-position
// https://dis.dankook.ac.kr/lectures/med08/wp-content/uploads/sites/35/1/1321343577.pdf 
    

	int w=800+300;
	int h=480;
    Fl::scheme("plastic");	
	// win=new Fl_Double_Window(0,0,w,h,"frobot");   
	win=new Fl_Double_Windowc(0,0,w,h,"frobot");  
	flt=new Fl_Double_Window(0,   0, 160, 480);
	Fl_Button* bt1=new Fl_Button(0,  0, 30, 20,"Alpha");
	Fl_Button* bt2=new Fl_Button(30,  0, 30, 20,"rota");
	Fl_Button* bt3=new Fl_Button(60,  0, 30, 20,"gview");
	Fl_Button* bt4=new Fl_Button(90,  0, 30, 20,"MV");
	Fl_Button* bt5=new Fl_Button(120,  0, 30, 20,"fit");
	Fl_Button* bt6=new Fl_Button(0,  20, 30, 20,"ik");
	Fl_Button* bt7=new Fl_Button(30,  20, 30, 20,"lua");
	Fl_Button* bt8=new Fl_Button(60,  20, 30, 20,"Lrun");
	Fl_Button* bt9=new Fl_Button(90,  20, 30, 20,"rvis");
	Fl_Button* bt10=new Fl_Button(120,  20, 30, 20,"ucs");
	Fl_Button* bt11=new Fl_Button(0,  40, 30, 20,"dbg");
	Fl_Button* bt12=new Fl_Button(30,  40, 30, 20,"mak");
	time_input=new Fl_Input(60,  40, 30, 20 );
	time_input->textsize(12);
	time_input_btn=new Fl_Toggle_Button(90,  40, 30, 20,"hdbg");
	Fl_Button* time_f_btn=new Fl_Button(120,  40, 30, 20,"Tdbg");
	Fl_Button* btpause=new Fl_Button(0,  60, 30, 20,"pause");
	Fl_Button* btnext=new Fl_Button(30,  60, 30, 20,"next");
	Fl_Button* btcancel=new Fl_Button(60,  60, 30, 20,"cancel");
	Fl_Button* btcam=new Fl_Button(90,  60, 30, 20,"cam");
	

	
	// Fl_Input_Choice in(0,150,100,28,"Test");
    // in.menubutton()->add("one");
    // in.menubutton()->add("two");
    // in.menubutton()->add("three");
	
	sql3_init();	
	Gamepad_Init();
	// win->show(); Fl::run(); return 0;
	
	fle=new FlEditor(0,150,160,400-150);
	fle->load();
	flt->resizable(fle);   
	flt->end();
	flcv=new Fl_ViewerCV(800,0,300,300); //opencv
	osggl=new ViewerFLTK(160,  0, 800-160, 480-10); 
	Fl::event_dispatch(OnKeyPress);
	osgViewer::StatsHandler *sh = new osgViewer::StatsHandler;
	sh->setKeyEventTogglesOnScreenStats('p');
    osggl->addEventHandler(sh);
    // osggl->addEventHandler(new osgViewer::StatsHandler); 
   
	tmr=new osgGA::TrackballManipulator;
	
	// fparse(fle->texto->text(),9);
 
	
	// flocv=new flocvs;
	 
	// setview();
 
	loadstl(group);

	geraeixos(group);
	osggl->setSceneData(group);
	
	
	fldbg=new Fl_Help_View(800,420+10,300,60);
	// fldbg->textcolor(FL_RED);
	fldbg->textfont(5);
	fldbg->textsize(14);
	fldbg->value("<font face=Arial > <br></font>");
	string fldbgstr="<b>Alt+z run</b><br><b>Alt+x run line</b>";
	fldbg->value(fldbgstr.c_str());
	
	//botoes dos angulos
	Fl_Double_Window* flpos=new Fl_Double_Window(800, 310, 300, 120);   
	// Fl_Double_Windowc* flpos=new Fl_Double_Windowc(800, 310, 300, 480-300);   
	Fl_Box* flposbox=new Fl_Box(0, 0, 300, 120);   
	// cot(flpos->w());
	// vector<vector<Fl_Button*>> btp(ve.size());
	// struct vix{int index;float angle; };	
	// vector<vector<vix*>> vixs(> btp(ve.size())
	btp=vector<vector<Fl_Button*>> (ve.size()); 
	vixs=vector<vector<vix*>> (ve.size());
		// cot(ve.size());
	lop(vei,0,ve.size()){
		// cot(button_width);
		// string bs=
		float btn=ve[vei]->anglemin/10.0*10;
		int btnsz=( ve[vei]->anglemax/10.0 ) - btn/10+1;
		// cot(btnsz);
		// cot(btn);
		// cot(ve[vei]->anglemax/10.0*10);
		btp[vei]=vector<Fl_Button*>(btnsz);
		vixs[vei]=vector<vix*>(btnsz);
		float button_width=flpos->w()/(float)btp[vei].size();
		lop(i,0,btp[vei].size()){ 
			const char* button_val=to_string(i).c_str();
			btp[vei][i]=new Fl_Button(i*button_width,20*vei,button_width,20); 
				// btp[vei][i]->color(FL_GREEN);
			// btp[i]->copy_label(button_val);
			btp[vei][i]->copy_label(to_string((int)abs(btn/10)).c_str() );
		// cot(to_string((int)abs(btn/10)));
			vix* vsend=new vix({vei,btn});
			vixs[vei][i]=vsend;
			btp[vei][i]->callback([](Fl_Widget *, void* v){ 
				vix* vv=(vix*)v; 
				// cot(vv->index);
				// cot(vv->angle);
				posv* p=new posv;
				// first_mtx.unlock();
				// mtxunlock(vv->index+1);
				// mut[vv->index+1].unlock();
				ve[vv->index]->rotatetoposition(vv->angle,p,1);
				// ve[vv->index]->rotatetoposition(vv->angle,p); //solved dont kwnow why could lead to future problems see mutexs
				// threadDetach([&]{
					// sleepms(10000);
					// delete p;
				// });
				// ve[vv->index]->rotate_pos(vv->angle);
			},(void*)vsend);
			btn+=10;
		}
	}
	flpos->resizable(flposbox);
	flpos->end();
   
   

	// osg::Matrix mat = osg::computeWorldToLocal(loadedModel.get());        
// std::cout << "X: " << mat.getTrans().x() << std::endl;      
// std::cout << "X: " << mat.getTrans().y() << std::endl;      
// std::cout << "X: " << mat.getTrans().z() << std::endl;
// std::cout << "Rot X: " << mat.getRotate().x() << std::endl;
// std::cout << "Scale X: " << mat.getScale().x() << std::endl;

	
	bt1->callback([](Fl_Widget *, void* v){ 	  
		toggletransp();	  
	});
	
	bt2->callback([](Fl_Widget *, void* v){ 
		// flgl->resize(flgl->x(),flgl->y(),200,200); 
			// ve[1]->rotate( 10);
			// cot(*ve[1]->axisbegin ); 
			// cot(*ve[1]->axisend );  		
		threadDetach([]{
			lop(i,0,1900000000){
				sleepms(10); 
				if(Break)return;
				// ve[0]->rotate( 1);
				if(ve[0]->angle>180)ve[0]->dir=-1;
				if(ve[0]->angle<-140)ve[0]->dir=1;
				ve[0]->rotate( 1*ve[0]->dir);
				// cot(ve[0]->angle);
				
				
				if(ve[1]->angle>90)ve[1]->dir=-1;
				if(ve[1]->angle<-90)ve[1]->dir=1;
				ve[1]->rotate( 2*ve[1]->dir); 
				// cot(*ve[0]->axisend );
			}
		});
	}); 
			
	bt3->callback([](Fl_Widget *, void* v){  
		// ve[0]->rotate(Vec3f(0,0,1),45); 
		getview();
		// Break=1;
		
			// ve[0]->rotate( 10); 
			// cot(*ve[1]->axisbegin ); 
			// cot(*ve[1]->axisend );  
	});	
	
	bt4->callback([](Fl_Widget *, void* v){ 	
		makvisible = !makvisible;
        maquete->setNodeMask(makvisible ? 0xffffffff : 0x0);	
	});
	
	bt5->callback([](Fl_Widget *, void* v){ 
		ViewerFLTK* view=osggl;
		if ( view->getCamera() ){
			// http://ahux.narod.ru/olderfiles/1/OSG3_Cookbook.pdf
			double _distance=-1; float _offsetX=0, _offsetY=0;
			osg::Vec3d eye, center, up;
			view->getCamera()->getViewMatrixAsLookAt( eye, center,
			up );

			osg::Vec3d lookDir = center - eye; lookDir.normalize();
			osg::Vec3d side = lookDir ^ up; side.normalize();

			const osg::BoundingSphere& bs = view->getSceneData()->getBound();
			if ( _distance<0.0 ) _distance = bs.radius() * 3.0;
			center = bs.center();
			center -= (side * _offsetX + up * _offsetY) * 0.1;
			fix_center_bug=center;
			tmr->setHomePosition( center-lookDir*_distance, center, up );
			osggl->setCameraManipulator(tmr);
			getview();
		}	
	});
	
	bt6->callback([](Fl_Widget *, void* v){ 	
		// ve[ve.size()-1]->rotate_posk(10);	
		dbg_pos();
		ve[3]->posik(vec3(150,150,-150));
	});
	
	bt7->callback([](Fl_Widget *, void* v){ 	
		if(fle->fname=="frobot.lua")
			fle->fname="frobot_f.lua";
		else
			fle->fname="frobot.lua";
		fle->load();
	});
	
	bt8->callback([](Fl_Widget *, void* v){ 	
		lua();	
	});
	
	bt9->callback([](Fl_Widget *, void* v){ 	
		robotvisible = !robotvisible;
		lop(i,0,ve.size()) lop(j,0,ve[i]->nodes.size())
			ve[i]->nodes[j]->setNodeMask(robotvisible ? 0xffffffff : 0x0);	
	});

	bt10->callback([](Fl_Widget *, void* v){ 	 
        ucs_icon->setNodeMask( (ucs_icon->getNodeMask()==0x0) ? 0xffffffff : 0x0);	
	});
	
	bt11->down_color(FL_RED ); 
	bt11->type(FL_TOGGLE_BUTTON);
	bt11->callback([](Fl_Widget *, void* v){ 
		posa_debug=!posa_debug;
		dbg_pos();	
	});
	
	bt12->callback([](Fl_Widget *, void* v){ 	 
        maquete->setNodeMask( (maquete->getNodeMask()==0x0) ? 0xffffffff : 0x0);	
	});
	
	time_f_btn->callback([](Fl_Widget *, void* v){ 	
		// Config cfg =  serialize(pool);
		// cot(cfg);
        time_f();	
		pressuref=4;
		elevator_go(3);
	});
	
	btpause->down_color(FL_RED ); 
	btpause->type(FL_TOGGLE_BUTTON);
	btpause->callback([](Fl_Widget *, void* v){ 
		Fl_Button* btpause=(Fl_Button*)v; 
		if(btpause->value()==1)
			lop(i,0,pool.size())
				pool[i]->pause=1;
		else
			lop(i,0,pool.size())
				pool[i]->pause=0;	
		
		cot1(btpause->value());
	},btpause);
	
	btnext->callback([](Fl_Widget *, void* v){ 
		Fl_Button* btnext=(Fl_Button*)v; 
		if(pool.size()==0)return;
		posa_erase_mtx.lock();
		pool[0]->pause=0;
		lop(i,1,pool.size())
			pool[i]->pause=1;
		posa_erase_mtx.unlock();
				
	},btnext);
	
	btcancel->callback([](Fl_Widget *, void* v){ 
		Fl_Button* btcancel=(Fl_Button*)v; 
		if(pool.size()==0)return;
		posa_erase_mtx.lock();
		lop(i,0,pool.size())
			pool[i]->cancel=1;
		posa_erase_mtx.unlock();
				
	},btcancel);
	
	btcam->down_color(FL_RED );
	btcam->type(FL_TOGGLE_BUTTON);
	btcam->callback([](Fl_Widget *, void* v){ 
		Fl_Button* btcam=(Fl_Button*)v; 
		if(btcam->value()){
			Break=1;
		}else Break=0;
				cot1(Break);
				cot1(btcam->value());
	},btcam);
	
	
	bt5->do_callback();
	// fix_center_bug.x()=500;
	// fix_center_bug.y()=500; 
	// cot(fix_center_bug.x());
	// wmove();
	
	interval(); //perform tasks of the robot
	
	fle->hide();
	flscroll->show();   
	threadDetach([]{sleepms(1200);cot(flscroll->yposition ());flscroll->scroll_to(0,0);flscroll->redraw(); flscroll->damage(1);}); 
	bt14->setonly(); 
	
	// fann_init();
	// train();
	// fann_calc();
	
	Fl::scheme("gtk+"); 
	#if 1
	((Fl_Widget*)win)->callback([](Fl_Widget *widget, void* v){ 
	    Fl_Window *window = (Fl_Window *)widget;		
		if (Fl::event()==FL_SHORTCUT && Fl::event_key()==FL_Escape) 
			return; // ignore Escape
		Break=1;
		if(flocv)flocv->close();
		sleepms(50);
		// threadDetach([]{
			// sleepms(500);
			// exit(0);
		// });
			// sleepms(100);
			exit(0); 
	}); 
	#endif 
	win->clear_visible_focus(); 	 
	win->color(0x7AB0CfFF);
	win->resizable(win);
	
	int X,Y,W,H;
	Fl::screen_work_area(X,Y,W,H,0,0);	
	win->resize(X,Y,W*.8,H*.8);
	
	win->position(Fl::w()/2-win->w()/2,0);
	win->show();   


	osggl->make_current();
#ifdef GLEW
  	glewExperimental = GL_TRUE;
	glewInit();
	//Print info of GPU and supported OpenGL version
	printf("Renderer: %s\n", glGetString(GL_RENDERER));
	printf("OpenGL version supported %s\n", glGetString(GL_VERSION));
#ifdef GL_SHADING_LANGUAGE_VERSION
	printf("Supported GLSL version is %s.\n", (char *)glGetString(GL_SHADING_LANGUAGE_VERSION));
#endif
    printf("Using GLEW version %s.\n", glewGetString(GLEW_VERSION));
	printf("------------------------------\n");  
#endif
	Fl::run();
}
//To do
//acabar o pik2
//adjust to 40' container